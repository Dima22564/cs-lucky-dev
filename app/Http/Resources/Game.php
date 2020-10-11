<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Bet as BetResource;

class Game extends JsonResource
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
      'multiplier' => $this->multiplier,
      'status' => $this->status,
      'hash' => $this->hash,
      'skins' => $this->skins,
      'players' => $this->players,
      'bank' => $this->bank,
      'color' => $this->color,
      'bets' => BetResource::collection($this->whenLoaded('bets'))
    ];
  }
}
