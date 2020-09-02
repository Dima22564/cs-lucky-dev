<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
  protected $fillable = ['message', 'user_id'];

  protected $table = 'chat';

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function getCreatedAtAttribute($value) 
  {
    $time = new Carbon($value);
    return $time->toTimeString();
  }

}
