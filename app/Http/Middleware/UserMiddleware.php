<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
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
        //获取登录用户的session
        $value = $request->session()->get('user', 'defaultuser');
        if($value =='defaultuser'){
            return redirect('user/login');
        }
        return $next($request);
    }
}
