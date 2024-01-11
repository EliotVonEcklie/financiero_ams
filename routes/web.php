<?php

use Illuminate\Http\Request;
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

Route::name('public.')->group(function () {
    Route::get('/', function () {
        return inertia('Public/Index');
    })->name('index');

    Route::get('/impuesto_predial_unificado', function (Request $request) {
        return inertia('Public/ImpuestoPredialUnificado', [
            'predios' => $request->query('search')
        ]);
    })->name('impuesto_predial_unificado');
});
