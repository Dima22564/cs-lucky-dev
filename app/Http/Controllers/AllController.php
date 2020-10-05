<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController as Controller;
use App\Http\Resources\Bet as BetResource;

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
      ->get()
      ->sortBy('created_at')
      ->reverse();

    return $this->sendResponse([
      'bets' => BetResource::collection($bets)
    ], 'Ok', 200);
  }

  private function getGameInController()
  {
    return Game::query()->orderBy('id', 'DESC')->first();
  }
}
