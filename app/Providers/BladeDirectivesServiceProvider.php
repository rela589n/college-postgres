<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Route;

class BladeDirectivesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::if(
            'ifroute',
            static function ($routeName) {
                return Str::startsWith(Route::currentRouteName(), $routeName);
            }
        );

        $this->registerSectionOnce();
    }

    private function registerSectionOnce(): void
    {
        Blade::directive(
            'sectionOnce',
            static function ($name) {
                return Blade::compileString(
                    <<<EOT
@hasSection($name)
@else
@section($name)
EOT
                );
            }
        );

        Blade::directive(
            'showSectionOnce',
            static function () {
                return Blade::compileString(
                    <<< EOT
@show
@endif
EOT
                );
            }
        );
    }
}
