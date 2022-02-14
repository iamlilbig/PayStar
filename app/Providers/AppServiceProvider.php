<?php

namespace App\Providers;

use App\Http\PaymentMethods\PaymentContract;
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
        $this->app->bind(PaymentContract::class, function () {
            $container = 'App\Http\PaymentMethods\\'.request()->bank.'Pay';
            return new $container();
        });
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
