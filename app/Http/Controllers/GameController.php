<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Events\GamePrepare;
use App\Events\GameStart;
use App\Events\PrepareEnd;
use App\Game;
use App\Http\Resources\Bet as BetResource;
use App\Http\Resources\Inventory as InventoryResource;
use App\Item;
use App\Jobs\NewGame;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Jobs\PrepareGame;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\API\BaseController as Controller;
use App\Http\Resources\Item as ItemResource;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class GameController extends Controller
{
  public function crashBets()
  {
    try {
      DB::beginTransaction();
      $game = $this->getGameInController();
      Bet::query()
        ->where('game_id', $game->id)
        ->where('is_win', null)
        ->with(['user' => function ($query) {
          $query->select('id', 'avatar');
        }])
        ->with('items')
        ->update([
          'is_win' => 0,
          'multiplier' => $game->multiplier
        ]);

      $bets = $this->getBets();

      $bank = Bet::query()
        ->where('game_id', $game->id)
        ->sum('bank');
      $win = Bet::query()
        ->where('game_id', $game->id)
        ->sum('win_bank');

      $game->update([
        'profit' => $bank - $win
      ]);
      DB::commit();

      return $this->sendResponse([
        'bets' => BetResource::collection($bets),
        'games' => $this->getLastGames()
      ]);
    } catch (\Exception $e) {
      DB::rollBack();
      return $this->sendError('Something went wrong! :(', []);
    }

  }

  public function makeBet(Request $request)
  {
    $betItemsIds = json_decode($request->get('betItems'));
    if (!$request->get('betItems')) {
      return $this->sendError('No bet items!', [], 404);
    }

    $game = $this->getGameInController();
    if ($game->status > Game::$GAME_PREPARE) {
      return $this->sendError('Game error', [], 404);
    }

    $betExists = Bet::where('user_id', Auth::user()->id)
      ->where('game_id', $game->id)
      ->where('is_win', null)
      ->first();

//    if ($betExists) {
//      return $this->sendError('Bet already done!', [], 404);
//    }

    $items = DB::table('items')
      ->whereIn('id', $betItemsIds)
      ->get();
    $bank = $items->sum('price');

    Cache::forget('betItems');
    Cache::put('betItems', $items);

//    Удаляем предметы из инвентаря
//    Считаем сумму стоимостей поставленных предметов
//    $items->each(function ($item, $key) {
//      DB::table('inventories')
//        ->where('user_id', Auth::user()->id)
//        ->where('item_id', $item->id)
//        ->limit(1)
//        ->delete();
//    });

// Создаем ставку
    $bet = Bet::create([
      'user_id' => Auth::user()->id,
      'game_id' => $this->getGameInController()->id,
      'bank' => $bank,
      'skins' => $items->count(),
    ]);
    $bet->items()->attach($betItemsIds);

//    Обновляем данные игры: банк и количество скинов
    $game->update([
      'bank' => $game->bank + $bank,
      'skins' => $items->count()
    ]);

    return $this->sendResponse([
      'bet' => [
        'id' => $bet->id,
        'bank' => $bet->bank,
        'items' => ItemResource::collection($items),
        'isWin' => null,
        'winBank' => 0,
        'autoWithdraw' => (float)$request->get('autoWithdraw'),
        'multiplier' => null,
        'user' => [
          'id' => Auth::user()->id,
          'avatar' => Auth::user()->avatar
        ]
      ],
      'inventory' => InventoryResource::collection(Auth::user()->inventory()),
    ], 'Ok', 200);
  }

  public function autoTake(Request $request)
  {
    $users = json_decode($request->get('users'));
    $multiplier = $request->get('multiplier');
    $game = $this->getGameInController();

    foreach ($users as $user) {

      $bet = Bet::where('user_id', $user->userId)
        ->where('game_id', $game->id)
        ->where('is_win', null)
        ->first();

      if (!$bet) {
        continue;
      }

      $winBank = round($bet->bank * $multiplier, 2);
      $winItem = Item::query()
        ->where('price', '<=', $winBank)
        ->orderBy('price', 'DESC')
        ->first();
      // TODO change user balance
      // TODO add win item
      $bet->update([
        'is_win' => 1,
        'win_bank' => $winBank,
        'multiplier' => $multiplier
      ]);
    }

    $bets = Bet::query()
      ->where('game_id', $game->id)
      ->with(['user' => function ($query) {
        $query->select('id', 'avatar');
      }])
      ->with('items')
      ->get()
      ->sortBy('created_at')
      ->reverse();

    return $this->sendResponse([
      'bets' => BetResource::collection($bets),
    ], 'Ok', 200);
  }

  public function getGame(Request $request)
  {
    $game = Game::where('status', '<', Game::$GAME_END)->first();

    if (!$game) {
      Game::create([
        'multiplier' => 0.00,
        'status' => 0
      ]);
      $game = Game::orderBy('id', 'DESC')->first();
    }

    return $this->sendResponse(['game' => $game], 'Ok', 200);
  }

  public function setMultiplier(Request $request)
  {
    $status = $request->get('status');
    $game = $this->getGameInController();
    $game->update([
      'status' => $status
    ]);

    if ($status === Game::$GAME_START) {
      $preProfit = Game::query()->sum('profit');

      $profit = $preProfit - $game->bank;
      if ($profit < $this->config->profit) {
        $multiplier = 1.00;
      } else {
        if ($game->bank > 0) {
          $ost = $profit - $this->config->profit;

          if ($ost <= 0) {
            $multiplier = 1.00;
          } else {
            $max = round($ost / $game->bank, 2);

            if ($max < 1) {
              $max += 1;
            }
            if ($max >= 100.00) {
              $max = 99.99;
            }

            $multiplier = round(Game::generateMultiplier(1.00, $max), 2);
          }
        } else {
          $multiplier = round(Game::generateMultiplier(1.00, 2.00), 2);
        }
      }
      $strToHash = $multiplier . $profit . 'Some random string';
      $hash = hash('sha256', $strToHash);
      $game->update([
        'multiplier' => $multiplier,
        'hash' => $hash
      ]);
      return $this->sendResponse(['multiplier' => $multiplier], 'Ok', 200);
    }
  }

  private function getGameInController()
  {
    return Game::query()->orderBy('id', 'DESC')->first();
  }

  private function getBets()
  {
    return Bet::query()
      ->where('game_id', $this->getGameInController()->id)
      ->with(['user' => function ($query) {
        $query->select('id', 'avatar');
      }])
      ->with('items')
      ->get()
      ->sortBy('created_at')
      ->reverse();
  }

  private function getLastGames()
  {
    return Game::orderBy('id', 'DESC')
      ->select('id', 'hash', 'multiplier')
      ->limit(20)
      ->get();
  }
}
