<?php

namespace App\Providers;

use App\Http\PaymentMethods\PaymentContract;
use App\Models\Credential;
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
            $bank = request()->credential->bank;
            $container = 'App\Http\PaymentMethods\\'.$bank.'Pay';
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
