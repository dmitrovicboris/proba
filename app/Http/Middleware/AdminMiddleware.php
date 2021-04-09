<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if($request->session()->has('korisnik')){

            if($request->session()->get('korisnik')->naziv == 'admin'){

                return $next($request);

            }
            else {
                return redirect()->back()->with('error','Nemate pristup ovoj stranici');
            }

        }
        else {
            return redirect()->back()->with('error','Nemate pristup ovoj stranici');
        }
    }
}
