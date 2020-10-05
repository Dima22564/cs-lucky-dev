<?php


namespace App\Http\Services\Game;


use App\Bet;
use App\Game;

class CreateOrFindGameService
{
  use GameTrait;

  public function handle()
  {
    $game = Game::where('status', '<', Game::$GAME_END)->first();

    if (!$game) {
      Game::create([
        'multiplier' => 0.00,
        'status' => 0
      ]);
      $game = Game::orderBy('id', 'DESC')->first();
    }

    return $game;
  }

}
