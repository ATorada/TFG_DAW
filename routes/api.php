<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('/finances')->group(function () {
    Route::get('/', function () {
        $controller = new Api\FinanceController(); // Crea una instancia del controlador
        return response()->json($controller->index()); // Llama al método en la instancia
    });

    Route::resource('purchase', Api\PurchaseController::class);
    Route::resource('household', Api\HouseholdController::class);
    Route::resource('user', Api\UserController::class);

});


