<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {
        if ((Auth::check()&&Auth::user()->role_id==$role)||request()->segment(1)=='api') {
            return $next($request);
        }
        Auth::logout();
        return redirect('/');
    }
}
