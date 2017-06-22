<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class VisitorsMiddleware
{
    protected $languages = ['en','de'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(!Sentinel::check())
          return $next($request);
        elseif(Sentinel::getUser()->roles()->first()->slug == 'lieferant')
          return redirect('/');
        elseif(Sentinel::getUser()->roles()->first()->slug == 'kunde')
          return redirect('/startseite');
        elseif(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'admin')
          return redirect('/admin');
     }
}
