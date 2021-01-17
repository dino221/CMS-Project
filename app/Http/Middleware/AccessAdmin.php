<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AccessAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor') || Auth::user()->hasAnyRole('user'))
        {
            return $next($request);
        }
        return redirect ('home');
    }
}
