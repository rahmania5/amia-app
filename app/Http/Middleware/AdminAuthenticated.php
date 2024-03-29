<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class AdminAuthenticated
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
        if( Auth::check() )
        {
            // if user is not admin take him to his dashboard
            if (!Auth::user()->isAdmin()) {
                return redirect(route('home'));
            }

            // allow admin to proceed with request
            else if (Auth::user()->isAdmin()) {
                return $next($request);
            }
        }

        abort(404);  // for other users throw 404 error
    }
}
