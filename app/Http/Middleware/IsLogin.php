<?php

namespace App\Http\Middleware;

use Closure;

class IsLogin
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
        if(session()->get('user_id')){
            return $next($request);
        }else{
            return redirect('login/index')->with('errors','请尊重我的劳动成果');
        }
    }
}
