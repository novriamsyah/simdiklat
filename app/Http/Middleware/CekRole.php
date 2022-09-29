<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $roles = array_slice(func_get_args(), 2);

        foreach ($roles as $role) {
            $user = \Auth::user()->role;

            if ($user == $role) {
                return $next($request);
            } 
        }
        return back();
    }

    // public function handle($request, Closure $next, ...$levels)
    // {
    //     dd($levels);
    //     if (in_array($request->user()->role,$levels)){
    //         return $next($request);
    //     }
    //     return back();
    // }

    
    


}
