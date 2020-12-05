<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\View\View;

class AuthUserViewComposer
{
    private StatefulGuard $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function compose(View $view)
    {
        $view->with(['authUser' => $this->guard->user()]);
    }
}
