<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Item as ItemResource;

class Bet extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param \Illuminate\Http\Request $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'bank'=> $this->bank,
      'skins' => $this->skins,
      'isWin' => $this->is_win,
      'items' => ItemResource::collection($this->whenLoaded('items')),
      'winBank' => $this->win_bank,
      'multiplier' => $this->multiplier,
      'user' => $this->whenLoaded('user'),
      'winItem' => new ItemResource($this->whenLoaded('winItem'))
    ];
  }
}
