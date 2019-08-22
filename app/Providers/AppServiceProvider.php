<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        Blade::directive('datetime', function ($expression) {
            $template = '';
            if (is_int($expression)){
                $template = "<?= date('d.m.y H:i', $expression); ?>";
            } else {
                $expression = strtotime($expression);
                $template = "<?= date('d.m.y H:i', $expression); ?>";
            }
            return $template;
        });

        Blade::directive('auth', function ($expression) {
            if ($expression) {
                $template = "<?php if(Auth::user() && Auth::user()->hasRole($expression)) : ?>";
            } else {
                $template = '<?php if(Auth::user()) : ?>';
            }
            return $template;
        });

        Blade::directive('guest', function ($expression) {
            if ($expression) {
                $template = "<?php if(!Auth::user() || !Auth::user()->hasRole($expression)) : ?>";
            } else {
                $template = '<?php if(!Auth::user()) : ?>';
            }
            return $template;
        });
    }
}
