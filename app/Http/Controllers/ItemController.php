<?php

namespace App\Http\Controllers;

use App\Http\Resources\Inventory as InventoryResource;
use App\Http\Resources\Item as ItemResource;
use App\Inventory;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
  public function fill()
  {

  }

  public function index()
  {
    $items = Cache::remember('itemsToExchange', 3600, function () {
      return collect(Item::all());
    });

    $sendItems = $items
      ->where('price', '<=', Auth::user()->balance)
      ->take(30);

    return $this->sendResponse([
      'exchangeItems' => ItemResource::collection($sendItems)
    ], 'Ok', 200);
  }

  public function change(Request $request)
  {
    $changeItemsIds = json_decode($request->get('itemsToChange'));
    $receiveItemsIds = json_decode($request->get('itemsToReceive'));

    $items = [];

    if ($changeItemsIds) {
      foreach ($changeItemsIds as $i) {
        $f = Item::find($i);
        array_push($items, $f);
      }
    }

    $itemCollection = collect($items);
    $sumForChange = round($itemCollection->sum('price') + Auth::user()->balance, 2);

    $sumForReceive = round(Item::findMany($receiveItemsIds)->sum('price'), 2);

    $remain = $sumForChange - $sumForReceive;

    if ($remain < 0) {
      return $this->sendError('Not enough money!', [], 400);
    }

//    TODO delete items from inventory
    Auth::user()->setBalance(round($remain, 2));
//    if ($changeItemsIds) {
//      DB::table('inventories')
//        ->delete($changeItemsIds);
//    }

    $insertItems = [];
    foreach ($receiveItemsIds as $i) {
      $item = [
        'user_id' => Auth::user()->id,
        'item_id' => $i
      ];
      array_push($insertItems, $item);
    }

    DB::table('inventories')
      ->insert($insertItems);

    return $this->sendResponse([
      'inventory' => InventoryResource::collection(Auth::user()->inventory()),
      $sumForChange,
      $sumForReceive,
    ], 'Ok', 200);

  }
}
