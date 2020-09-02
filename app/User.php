<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'username', 'email', 'avatar', 'steamid'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function messages() {
    return $this->hasMany(Chat::class);
  }

  public function games()
  {
    return $this->belongsToMany(Game::class, 'games_users');
  }

  public function betItems()
  {
    return $this->hasMany(BetItems::class);
  }

  public function winItems()
  {
    return $this->hasMany(WinItems::class);
  }
}