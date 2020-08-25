<?php

namespace App\Http\Middleware;

use Closure;

class CheckDetailExist
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
        if(empty($request->user()->detail)){
            return redirect('profile');
        }
        return $next($request);
    }
}
