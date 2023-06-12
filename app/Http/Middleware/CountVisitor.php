<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\visitors;
use Illuminate\Http\Request;

class CountVisitor
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
        $ip = hash('sha512', $request->ip());
        if (visitors::where('date', today())->where('ip', $ip)->count() < 1)
        {
            visitors::create([
                'date' => today(),
                'ip' => $ip,
            ]);
        }
        return $next($request);
    }

}
