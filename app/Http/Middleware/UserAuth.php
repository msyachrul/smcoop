<?php

namespace App\Http\Middleware;

use Closure;

class UserAuth
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

        if (empty($cek)) {
            return redirect('/masuk');
        }

        if ($cek['admin'] == true) {
            return redirect('/error')->withErrors('admin');
        }

        return $next($request);
    }
}
