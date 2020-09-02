<?php

namespace App\Http\Controllers;

use App\Events\GamePrepare;
use App\Events\GameStart;
use App\Events\PrepareEnd;
use App\Game;
use App\Jobs\NewGame;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Jobs\PrepareGame;

class GameController extends Controller
{
    public function prepare()
    {
        // $multiplier = GAME::generateMultiplier();
        // $duration = GAME::generateDuration($multiplier);
        // $hash = GAME::generateHash($duration);
        // $game_start = new Carbon();

        // $game = new Game();
        // $game->hash = $hash;
        // $game->duration = $duration;
        // $game->multiplier = $multiplier;
        // $game->status = Game::$GAME_PREPARE;
        // $game->game_start = $game_start->toDateTimeString();
        // $game->game_end = $game_start->addSeconds(floor($duration))->toDateTimeString();
        // $game->save();

        // event(new GamePrepare($game));
        // dispatch(new NewGame($game))->delay(Carbon::now()->addSeconds(11));


        dispatch(new PrepareGame())->onQueue('game');
        // return \response()->json([
        //     'success' => true,
        //     'data' => $game
        // ]);
    }

    public function start(Request $request) {
        
    }
}
