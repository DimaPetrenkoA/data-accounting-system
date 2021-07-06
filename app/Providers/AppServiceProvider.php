<?php

namespace App\Providers;

use App\CustomValidator;
use App\Services\InputPolicesHandler;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
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
        $this->app->bind(InputPolicesHandler::class, function ($app) {
            return new InputPolicesHandler();
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Validator::resolver(function($translator, $data, $rules, $messages, $attributes)
        {
            return new CustomValidator($translator, $data, $rules, $messages, $attributes);
        });

    }
}
