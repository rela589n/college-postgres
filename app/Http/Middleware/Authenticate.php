<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Guards\GuardResolver;
use App\Routes\AuthenticationRoutesFactory;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    private array $savedGuards;

    public function handle($request, Closure $next, ...$guards)
    {
        $this->savedGuards = $guards;

        return parent::handle($request, $next, ...$guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return AuthenticationRoutesFactory::resolve(GuardResolver::reverse(...$this->savedGuards))::login();
        }
    }
}
