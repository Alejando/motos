<?php

namespace DwSetpoint\Providers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class Helpers extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('helpers',function(){
            return new \DwSetpoint\Libs\Helpers\Helper;
        });
    }
}
