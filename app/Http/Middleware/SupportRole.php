<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SupportRole {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            $user = Auth::guard($guard)->user();

            if ($user->isSupport()) {
                if($user->status === 0){
                    Auth::logout();
                    abort(403, 'Account has been disabled!');
                }
                return $next($request);
            }

            abort(403);
        }

        return redirect()->route('login');
    }
}
