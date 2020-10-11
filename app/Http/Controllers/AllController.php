<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController as Controller;
use App\Http\Resources\Bet as BetResource;
use App\Http\Resources\Game as GameResource;

class AllController extends Controller
{
  public function __invoke(Request $request)
  {
    $gameId = $this->getGameInController()->id;
    $bets = Bet::query()
      ->where('game_id', $gameId)
      ->with(['user' => function ($query) {
        $query->select('id', 'avatar');
      }])
      ->with('items')
      ->with('winItem')
      ->get()
      ->sortBy('created_at')
      ->reverse();

    $games = Game::query()
      ->where('status', Game::$GAME_END)
      ->orderBy('id', 'DESC')
      ->limit(20)
      ->get();

    return $this->sendResponse([
      'bets' => BetResource::collection($bets),
      'games' => GameResource::collection($games)
    ], 'Ok', 200);
  }

  private function getGameInController()
  {
    return Game::query()->orderBy('id', 'DESC')->first();
  }
}
