<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::apiResource('article', ArticleController::class)->only([
    'index', 'show',
]);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('article', ArticleController::class)->only([
        'store', 'update', 'destroy',
    ]);
});


