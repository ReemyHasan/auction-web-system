<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{

    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Response::macro('format', function ($data = null, $message = 'Success', $code = 200, $success = true) {
            return response()->json([
                'success' => $success,
                'message' => __($message),
                'data' => $data,
            ], $code);
        });
    }
}
