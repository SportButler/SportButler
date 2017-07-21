<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

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
      if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'admin')
          return $next($request);
        elseif(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'lieferant')
          return redirect('/');
        elseif(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'kunde')
          return redirect('/startseite');
        else
          return redirect('/login');
    }
}
