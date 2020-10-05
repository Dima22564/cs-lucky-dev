<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\Inventory as InventoryResource;
use App\Http\Resources\Item as ItemResource;

use App\Http\Controllers\BaseController as Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTAuth;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $user = auth()->parseToken();
    return response()->json(Auth::user(), 200);
  }

  public function inventory()
  {
//    return Auth::user()->inventory();
    return $this->sendResponse([
      'inventory' => InventoryResource::collection(Auth::user()->inventory())
    ], 'Ok', 200);
  }
}
