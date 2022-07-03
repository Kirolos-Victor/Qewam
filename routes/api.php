<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\InvoiceController;
use App\Http\Controllers\API\SessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1', 'middleware' => ['auth:sanctum']], function () {
    Route::get('me', [AuthController::class, 'me']);
    //Customers
    Route::get('customers', [CustomerController::class, 'index']);
    Route::post('customers/create', [CustomerController::class, 'create']);
    Route::post('customers/{customer}/attach-user', [CustomerController::class, 'attachUser']);
    //Invoices
    Route::get('invoices/{invoice}', [InvoiceController::class, 'index']);
    Route::post('invoices', [InvoiceController::class, 'create']);
    //Sessions
    Route::post('sessions/create', [SessionController::class, 'create']);
});
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
