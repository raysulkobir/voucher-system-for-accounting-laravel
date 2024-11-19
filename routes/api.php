<?php

use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VoucherTypeController;
use App\Models\Customer;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('product', ProductController::class, [
    'only' => ['index', 'show', 'store', 'create', 'update', 'destroy']
]);
Route::apiResource('voucher-type', VoucherTypeController::class, [
    'only' => ['index', 'show', 'store', 'create', 'update', 'destroy']
]);
Route::apiResource('accounts', AccountsController::class, [
    'only' => ['index', 'show', 'store', 'create', 'update', 'destroy']
]);
Route::apiResource('voucher-types', VoucherTypeController::class, [
    'only' => ['index', 'show', 'store', 'create', 'update', 'destroy']
]);
Route::apiResource('customer', CustomerController::class, [
    'only' => ['index', 'show', 'store', 'create', 'update', 'destroy']
]);
