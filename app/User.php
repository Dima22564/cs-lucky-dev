<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
  use Notifiable;

  public function getJWTIdentifier()
  {
    return $this->getKey();
  }

  public function getJWTCustomClaims()
  {
    return [];
  }

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

  public function messages()
  {
    return $this->hasMany(Chat::class);
  }

  public function bets()
  {
    return $this->hasMany(Bet::class);
  }

  public function inventory()
  {
    return DB::table('inventories')
      ->join('items', 'inventories.item_id', '=', 'items.id')
      ->orderBy('items.price')
      ->where('user_id', $this->id)
      ->get();
  }

  public function winItems()
  {
    return $this->hasMany(WinItems::class);
  }
}
