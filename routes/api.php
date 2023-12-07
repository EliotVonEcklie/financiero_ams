<?php

use App\Http\Controllers\DestinoEconomicoController;
use App\Http\Controllers\HistorialPredioController;
use App\Http\Controllers\AvaluoController;
use App\Http\Controllers\PredioController;
use App\Http\Controllers\IgacFileParserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('destino_economicos', DestinoEconomicoController::class);

Route::get('/predios/search', [PredioController::class, 'search'])->name('api.predios.search');
Route::apiResource('predios', PredioController::class);

Route::get('/predios/{predio}/historial_predios/latest', [HistorialPredioController::class, 'latest'])->name('api.predios.historial_predios.latest');
Route::apiResource('predios.historial_predios', HistorialPredioController::class);

Route::get('/predios/{predio}/avaluos/latest', [AvaluoController::class, 'latest'])->name('api.predios.avaluos.latest');
Route::apiResource('predios.avaluos', AvaluoController::class);

Route::post('/igac', [IgacFileParserController::class, 'store'])->name('api.igac');
