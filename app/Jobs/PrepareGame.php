<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Game;
use Carbon\Carbon;
use App\Events\GamePrepare;
use App\Jobs\NewGame;

class PrepareGame implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $multiplier = GAME::generateMultiplier();
        $duration = GAME::generateDuration($multiplier);
        $hash = GAME::generateHash($duration);
        $game_start = new Carbon();

        $game = new Game();
        $game->hash = $hash;
        $game->duration = $duration;
        $game->multiplier = $multiplier;
        $game->status = Game::$GAME_PREPARE;
        $game->game_start = $game_start->toDateTimeString();
        $game->game_end = $game_start->addSeconds(floor($duration))->toDateTimeString();
        $game->save();

        event(new GamePrepare($game));
        dispatch(new NewGame($game))->onQueue('game')->delay(Carbon::now()->addSeconds(11));
    }
}
