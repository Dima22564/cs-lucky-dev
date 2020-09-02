<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use App\Events\Message;
use App\User;
use Illuminate\Support\Carbon;

class ChatController extends Controller
{
  public function store(Request $request)
  {
//    TODO: change for auth
    $message = [
      'message' => $request->get('message'),
      'user_id' => 3
    ];

    $chat = Chat::create($message);
    // $chat = new Chat($message);
    // $chat->save();
    // $time = new Carbon($chat->created_at);
    // TODO: change date format
    $chat->user = $chat->user;
    $chat->created_at = 11;
    event(new Message($chat));
  }

  public function index() 
  {
    $messages = Chat::with('user')->orderBy('created_at', 'desc')->take(50)->get()->reverse()->values();

    return $messages;
  }
}
