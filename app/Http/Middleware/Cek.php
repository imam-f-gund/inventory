<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cek
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$bagian)
    {
        if (in_array($request->user()->role_id, $bagian)) {
            return $next($request);
        }
        return redirect('/home');
    }
}
