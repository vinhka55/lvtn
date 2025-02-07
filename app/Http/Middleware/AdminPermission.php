<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Closure;
use Illuminate\Support\Facedes\Route;

class AdminPermission extends Middleware
{
    /**
     * Trong middleware không use Mode được
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request,Closure $next, ...$guards)
    {
        if(Auth::check()){
            if(Auth::user()->hasRole('admin')){
                return $next($request);
            }
        }
        return redirect('admin/login');
    }
}
