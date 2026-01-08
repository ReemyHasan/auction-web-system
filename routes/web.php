<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return response()->format(null, "messages.unauthenticated", 401, false);
})->name('login');
