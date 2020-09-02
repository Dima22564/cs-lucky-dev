<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\BaseController as Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        return response()->json(Auth::user(), 200);
    }
}
