<?php

namespace App\Jobs;

use App\Events\GameEnd;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Game;
use App\Jobs\PrepareGame;
use Carbon\Carbon;

class EndGame implements ShouldQueue
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
        $game->status = Game::$GAME_CRUSHED;
        $game->save();
        
        event(new GameEnd());
        dispatch(new PrepareGame())->onQueue('game')->delay(Carbon::now()->addSeconds(5));
    }
}
