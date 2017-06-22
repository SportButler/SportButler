<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class KundeMiddleware
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
      if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'kunde')
          return $next($request);
        elseif(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'admin')
          return redirect('/admin');
        elseif(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'lieferant')
            return redirect('/');
        else
          return redirect('/login');
    }
}
