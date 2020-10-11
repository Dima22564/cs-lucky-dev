<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAuth
{
  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    if (Auth::user()) {
      return $next($request);
    }

    return response()->json([
      'success' => false,
      'message' => 'Unauthorized'
    ], 401);
  }
}
