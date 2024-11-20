<?php

use App\Models\Accounts;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VoucherTypeController;

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
Route::apiResource('voucher', VoucherController::class, [
    'only' => ['index', 'show', 'store', 'create', 'update', 'destroy']
]);
Route::apiResource('customer', CustomerController::class, [
    'only' => ['index', 'show', 'store', 'create', 'update', 'destroy']
]);
Route::apiResource('ledger', LedgerController::class, [
    'only' => ['index', 'show', 'store', 'create', 'update', 'destroy']
]);
