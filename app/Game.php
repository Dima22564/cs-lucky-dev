<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
  protected $guarded = [];

  public static $GAME_PREPARE = 0;
  public static $GAME_START = 1;
  public static $GAME_END = 2;

  protected $fillable = [
    'hash',
    'status',
    'multiplier',
    'skins',
    'profit',
    'players',
    'bank',
    'color'
  ];

  public function bets()
  {
    return $this->hasMany(Bet::class);
  }

  public static function generateHash($duration)
  {
    $hash = md5((string)$duration . env('CS_LUCKY_SECRET'));
    return $hash;
  }

  public static function generateMultiplier($st_num = 0, $end_num = 1, $mul = 1000000)
  {
    if ($st_num > $end_num) return false;
    return mt_rand($st_num * $mul, $end_num * $mul) / $mul;
  }
}
