<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class admin
{
    public function handle($request, Closure $next)
    {
        if(is_admin()){
            return $next($request);
        } else {
            return redirect()->route('admin.login')->with('notify_error','You need to login before accessing Admin Dashboard');
        }
    }
    public function terminate($request, $response){
    	
    }
}
