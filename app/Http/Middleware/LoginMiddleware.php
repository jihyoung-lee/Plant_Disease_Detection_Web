<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginMiddleware
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
        // 만약 로그인이 되어 있지 않다면 로그인 페이지로 이동한다.
        if(auth()->check()===false) {
            return redirect('/login');
        }
        return $next($request);
    }
