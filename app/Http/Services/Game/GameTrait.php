<?php


namespace App\Http\Services\Game;


use App\Bet;
use App\Game;

trait GameTrait
{
  private function getCurrentInController()
  {
    return Game::query()->orderBy('id', 'DESC')->first();
  }

  private function getBets()
  {
    return Bet::query()
      ->where('game_id', $this->getCurrentInController()->id)
      ->with(['user' => function ($query) {
        $query->select('id', 'avatar');
      }])
      ->with('items')
      ->get()
      ->sortBy('created_at')
      ->reverse();
  }
}
