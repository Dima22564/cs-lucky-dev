<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
  protected $guarded = [];

  public static $GAME_PREPARE = 0;
  public static $GAME_START = 1;
  public static $GAME_CRUSHED = 2;
  public static $GAME_END = 3;

  public function users()
  {
    return $this->belongsToMany(User::class, 'games_users');
  }

  public static function generateHash($duration)
  {
    $hash = md5((string)$duration . env('CS_LUCKY_SECRET'));
    return $hash;
  }

  public static function generateMultiplier()
  {
    try {
      $multiplierInt = random_int(1, 20);
    } catch (\Exception $e) {
      $multiplierInt = rand(1, 20);
    }
    $multiplierFloat = rand(0, 100) / 100;
    $multiplier = $multiplierInt + $multiplierFloat;
    return $multiplier;
  }

  public static function generateDuration($multiplier)
  {
    // $duration = round((pow(2, $multiplier) - 1) / 2);
    $duration = round(log($multiplier ,2));
    return $duration;
  }
}
