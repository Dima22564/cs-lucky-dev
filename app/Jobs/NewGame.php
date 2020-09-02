<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Game;
use App\Events\GameStart;
use Carbon\Carbon;
use App\Jobs\EndGame;

class NewGame implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $game;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($game)
    {
        $this->game = $game;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $game = Game::find($this->game->id);
        $game->status = Game::$GAME_START;
        $game->save();

        event(new GameStart([14, 15]));
        dispatch(new EndGame($game))->onQueue('game')->delay(Carbon::now()->addSeconds($this->game->duration));
    }
}
