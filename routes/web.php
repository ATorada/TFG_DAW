<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::prefix('/finances')->group(function () {
    Route::get('/', function () {
        return view('finanzas.index');
    })->name('finance.index');

    Route::resource('purchases', Web\PurchaseController::class)->only(['index']);
    Route::resource('household', Web\HouseholdController::class)->only(['index']);
    Route::resource('user', Web\UserController::class)->only(['index']);

    Route::get('/income', function () {
        return view('finanzas.ingresos');
    })->name('finance.income');

    Route::get('/expenses', function () {
        return view('finanzas.gastos');
    })->name('finance.expenses');

    Route::get('/history', function () {
        return view('finanzas.historial');
    })->name('finance.history');

    Route::get('/account', function () {
        return view('finanzas.account');
    })->name('account');
});

/* Route::prefix('/finanzas')->group(function () {
    Route::get('/', function () {
        return view('finanzas.index');
    })->name('main');

    Route::get('/ingresos', function () {
        return view('finanzas.ingresos');
    })->name('ingresos');

    Route::get('/gastos', function () {
        return view('finanzas.gastos');
    })->name('gastos');

    Route::get('/comprasgrandes', function () {
        return view('finanzas.comprasgrandes');
    })->name('compragrande');

    Route::get('/unidadfamiliar', function () {
        return view('finanzas.unidadfamiliar');
    })->name('unidadfamiliar');

    Route::get('/historial', function () {
        return view('finanzas.historial');
    })->name('historial');
}); */
