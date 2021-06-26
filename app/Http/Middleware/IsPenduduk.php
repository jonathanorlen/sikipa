<?php
  
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class IsPenduduk
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
        if(Session::get('penduduk')){
            return $next($request);
        }
   
        return redirect()->route('login')->withError("Kamu tidak memiliki akses.");
    }
}