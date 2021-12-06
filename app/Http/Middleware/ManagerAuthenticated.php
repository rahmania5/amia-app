<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class ManagerAuthenticated
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
            // if (Auth::user()->isAdmin()) {
            //     return redirect(route('admin_home'));
            // }

            // else if (Auth::user()->isDistributor()) {
            //     return redirect(route('distributor_home'));
            // }

            // if user is not manager take him to his dashboard
            if (!Auth::user()->isManager()) {
                return redirect(route('home'));
            }

            // allow manager to proceed with request
            else if (Auth::user()->isManager()) {
                return $next($request);
            }
        }

        abort(404);  // for other users throw 404 error
    }
}
