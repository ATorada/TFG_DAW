<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('/finanzas')->group(function () {
    Route::get('/', function () {
        return view('finanzas.index');
    })->name('main');

    Route::get('/ingresos', function () {
        return view('finanzas.ingresos');
    })->name('ingresos');

    Route::get('/gastos', function () {
        return view('finanzas.gastos');
    })->name('gastos');

    Route::get('/compragrande', function () {
        return view('finanzas.compragrande');
    })->name('compragrande');

    Route::get('/unidadfamiliar', function () {
        return view('finanzas.unidadfamiliar');
    })->name('unidadfamiliar');

    Route::get('/historial', function () {
        return view('finanzas.historial');
    })->name('historial');

    Route::get('/account', function () {
        return view('finanzas.account');
    })->name('account');
});

