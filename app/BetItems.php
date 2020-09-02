<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BetItems extends Model
{
  protected $table = 'bet_items';

  protected $fillable = ['item_id', 'user_id', 'game_id'];

  public function user () {
    return $this->belongsTo(User::class);
  }
}
