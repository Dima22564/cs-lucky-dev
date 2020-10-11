<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
  protected $table = 'bets';

  protected $fillable = [
    'user_id',
    'game_id',
    'is_win',
    'bank',
    'skins',
    'win_bank',
    'multiplier'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function items()
  {
    return $this->belongsToMany(Item::class, 'bet_item');
  }

  public function games()
  {
    return $this->belongsTo(Game::class);
  }

  public function winItem()
  {
    return $this->belongsTo(Item::class, 'item_id');
  }


}
