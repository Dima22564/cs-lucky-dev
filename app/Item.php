<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $table = 'items';

  public function bets()
  {
    return $this->belongsToMany(Bet::class, 'bet_item');
  }
}
