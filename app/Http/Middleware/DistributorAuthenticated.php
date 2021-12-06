<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class DistributorAuthenticated
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
            if (!Auth::user()->isDistributor()) {
                return redirect(route('home'));
            }

            // allow distributor to proceed with request
            else if (Auth::user()->isDistributor()) {
                return $next($request);
            }
        }

        abort(404);  // for other users throw 404 error
    }
}
