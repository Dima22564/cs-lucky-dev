<?php

namespace App\Http\Controllers;

use App\BetItems;
use App\Events\MakeBet;
use App\Game;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\BaseController as Controller;

class BetController extends Controller
{
    public function makeBet(Request $request)
    {
        // TODO: add auth user
        // TODO: add current game_id
        // TODO: add normal items
        if (!Gate::allows('make-bet', $request->get('gameId'))) {
            $this->sendError('This game is wrong!');
        }
        $user = User::find(1);
        $game_id = 4;
        $user->games()->attach($game_id, [
            'status' => Game::$GAME_PREPARE,
            'bet' => 0,
        ]);

        $betItems = $request->get('betItems');
        foreach ($betItems as $item) {
            BetItems::create([
                'item_id' => $item['item_id'],
                'user_id' => 1,
                'game_id' => 4
            ]);
        }

        event(MakeBet::class, $betItems);

        $this->sendResponse([], 'Ok', 200);
    }
}
