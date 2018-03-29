<?php

namespace App\Http\Middleware;

use Closure;

class SessionAuth
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
       
        $cek = session('data');

        if (!empty($cek)) {
            if($cek['admin'] == true) {
                return redirect('/error')->withErrors('admin');
            }
            if($cek['admin'] != true) {
                return redirect('/error')->withErrors('user');
            }
        }
        
        return $next($request);
    }
}
