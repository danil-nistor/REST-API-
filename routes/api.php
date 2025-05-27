<?php

use App\Http\Controllers\DataApiController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Illuminate\Support\Facades\Route;

Route::middleware(EnsureFrontendRequestsAreStateful::class)
    ->group(function () {
        Route::get('/export', [DataApiController::class, 'export']);
        Route::post('/import', [DataApiController::class, 'import']);
    });
