<?php

namespace App\Http\Middleware;

use App\Routes\AuthenticationRoutesFactory;
use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $statefulGuard = Auth::guard($guard);
        if ($statefulGuard->check()) {
            /** @var Authenticatable $user */
            $user = $statefulGuard->user();

            return redirect(
                $this->authenticationRoutesFor($user)::home()
            );
        }

        return $next($request);
    }

    public function authenticationRoutesFor(Authenticatable $user)
    {
        return AuthenticationRoutesFactory::resolve(
            get_class($user)
        );
    }
}
