<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JaneDoe
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->name == 'Jane Doe') {
            return response()->json(['errors' => 'Esse nome não pode'], 401);
        }

        return $next($request);
    }
}
