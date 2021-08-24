<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
// use BroCourier\Setting\SettingRepository;

class Doctor {
    // public function __construct(SettingRepository $settingRepo)
    // {
    //     $this->settingRepo = $settingRepo;
    // }
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

            if ($user->isDoctor()) {

                if($user->status === 0){
                    Auth::logout();
                    abort(403, 'Account has been disabled!');
                }

                // if($this->settingRepo->isMaintenance())
                // {
                //     Auth::logout();
                //     return redirect()->route('login')
                //                 ->withErrors(__('auth.account.undermaintenance'));
                // }

                return $next($request);
            }

            abort(403);
        }

        return redirect()->route('login');
    }
}
