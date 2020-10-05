<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Inventory extends JsonResource
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
      'userId' => $this->user_id,
      'itemId' => $this->item_id,
      'image' => $this->image,
      'name' => $this->name,
      'price' => $this->price,
      'marketHashName' => $this->market_hash_name
    ];
  }
}
