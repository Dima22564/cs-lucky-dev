<?php

namespace App\Http\Controllers;

use Invisnik\LaravelSteamAuth\SteamAuth;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AuthController extends Controller
{
  protected $steam;

  protected $redirectURL = 'http://localhost:3000';

  public function __construct(SteamAuth $steam)
  {
    $this->steam = $steam;
  }

  public function redirectToSteam()
  {
    return $this->steam->redirect();
  }

  public function handle()
  {
    if ($this->steam->validate()) {
      $info = $this->steam->getUserInfo();

      if (!is_null($info)) {
        $user = $this->findOrNewUser($info);

        $token = auth()->login($user);

        return redirect($this->redirectURL . '?token=' . $token); // redirect to site
      }

    }
    return $this->redirectToSteam();
  }

  protected function findOrNewUser($info)
  {
    $user = User::where('steamid', $info->steamID64)->first();

    if (!is_null($user)) {
      $user->update([
        'username' => $info->personaname,
        'avatar' => $info->avatarfull,
      ]);
//      $user->remember_token = Str::random(100);
      $user->save();
      return $user;

    }

    $user = User::create([
      'username' => $info->personaname,
      'avatar' => $info->avatarfull,
      'steamid' => $info->steamID64,
    ]);

//    $user->remember_token = Str::random(100);
//    $user->save();
    return $user;
  }

  public function logout(Request $request)
  {
//    $user = User::where('remember_token', $request->get('token'))->first();
//    $user->remember_token = null;
//    $user->save();
    Auth::logout();
    return response()->json('Ok');
  }

}
