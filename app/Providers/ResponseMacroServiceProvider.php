<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('toHttpCodeAndMap', function ($value) {
            $status = empty($value['responseCode']) ? 200 : $value['responseCode'];
            return Response::json(status: $status, data: $value);
        });
    }
}
