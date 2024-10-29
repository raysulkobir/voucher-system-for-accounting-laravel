<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('product', ProductController::class, [
    'only' => ['index', 'show', 'store', 'create', 'update', 'destroy']
]);
Route::apiResource('voucher-type', VoucherTypeController::class, [
    'only' => ['index', 'show', 'store', 'create', 'update', 'destroy']
]);
