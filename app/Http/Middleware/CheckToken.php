<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Bearer Token
        if (!strpos(($request->header())['authorization'][0], config('auth.secret_token'))) {
            return response()->json(['error' => true, 'message' => 'Token is Invalid'], 422);
        }

        return $next($request);
    }
}
