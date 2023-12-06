<?php

use App\Http\Controllers\DestinoEconomicoController;
use App\Http\Controllers\HistorialPredioController;
use App\Http\Controllers\AvaluoController;
use App\Http\Controllers\PredioController;
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

Route::middleware('api')->prefix('api')->group(function () {
    Route::apiResource('destino_economicos', DestinoEconomicoController::class);

    Route::get('/predios/search', [PredioController::class, 'search'])->name('predios.search');
    Route::apiResource('predios', PredioController::class);

    Route::get('/predios/{predio}/historial_predios/latest', [HistorialPredioController::class, 'latest'])->name('api.predios.historial_predios.latest');
    Route::apiResource('predios.historial_predios', HistorialPredioController::class);

    Route::get('/predios/{predio}/avaluos/latest', [AvaluoController::class, 'latest'])->name('api.predios.avaluos.latest');
    Route::apiResource('predios.avaluos', AvaluoController::class);
});

Route::middleware(['web'])->prefix('admin')->group(function () {
    Route::get('/destino_economicos', [DestinoEconomicoController::class, 'indexAdmin'])->name('admin.destino_economicos.index');
    Route::get('/destino_economicos/{destino_economico}', [DestinoEconomicoController::class, 'showAdmin'])->name('admin.destino_economicos.show');

    Route::get('/predios', [PredioController::class, 'indexAdmin'])->name('admin.predios.index');
    Route::get('/predios/{predio}', [PredioController::class, 'showAdmin'])->name('admin.predios.show');
    Route::get('/predios/{predio}/historial_predios', [HistorialPredioController::class, 'indexAdmin'])->name('admin.predios.historial_predios.index');
    Route::get('/predios/{predio}/avaluos', [AvaluoController::class, 'indexAdmin'])->name('admin.predios.avaluos.index');
});
