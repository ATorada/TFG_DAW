<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

use function PHPUnit\Framework\once;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('login', [Api\AuthController::class, 'login']);
Route::post('register', [Api\AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function ($request) {
    Route::get('user/profile', [Api\UserController::class, 'userProfile']);
    Route::post('logout', [Api\AuthController::class, 'logout']);

    Route::apiResource('finances', Api\FinanceController::class);
    Route::apiResource('purchases', Api\PurchaseController::class);
    Route::apiResource('households', Api\HouseholdController::class)->only(['store','destroy']);

    Route::put('user', [Api\UserController::class, 'update']);
    //Añade una ruta get para getHousehold
    Route::get('user/household', [Api\UserController::class, 'getHousehold']);
    Route::delete('user/leavehousehold', [Api\UserController::class, 'leaveHousehold']);
    Route::get('households/members', [Api\HouseholdController::class, 'getMembers']);
    Route::get('households/balance', [Api\HouseholdController::class, 'getBalance']);
    //households/join/{id}
    Route::post('households/join/{uuid}', [Api\HouseholdController::class, 'joinHousehold']);

    Route::get('income', [Api\FinanceController::class, 'getIncome']);
    Route::get('expenses', [Api\FinanceController::class, 'getExpenses']);

});
