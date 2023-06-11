<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PaymentGateway;
use App\Services\SmsServices\SmsService;
use App\Services\SmsServices\LocalSmsService;
use App\Services\SmsServices\ProdSmsService;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind('first_srvice_provider', function($app){
            return "This is first service provider";
        });
        // app()->bind(PaymentGateway::class, function(){
        //     return new PaymentGateway('12345');
        // });

        app()->bind(SmsService::class, function(){
            $request = app(Request::class);
        // dd($request->all());
            if($request->environment == 'local'){
                return new LocalSmsService();
            }
            return new ProdSmsService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
