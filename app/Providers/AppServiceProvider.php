<?php

namespace App\Providers;

use App\Models\EmailReset;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
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
        $this->app->bind(
            EmailReset::class, function ($app) {
                return new EmailReset();
            }
        );

        $this->app->bind(
            \Illuminate\Http\Request::class, function ($app) {
                return new HttpRequest();
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
