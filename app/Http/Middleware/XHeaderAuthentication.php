<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XHeaderAuthentication
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
        if($request->header('X-Api-Key') == env('X_API_KEY'))
            return $next($request);
        return response()->json(['message'=>'X-Api-Key Header is missing or incorrect'], 401, ['X-Api-Key' => '']);
    }
}
