<?php

declare(strict_types=1);

use App\Http\Controllers\DestinoEconomicoController;
use App\Http\Controllers\HistorialPredioController;
use App\Http\Controllers\AvaluoController;
use App\Http\Controllers\CodigoDestinoEconomicoController;
use App\Http\Controllers\PredioController;
use App\Http\Controllers\IgacParserController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return inertia('Welcome');
    })->name('index');

    Route::resource('destino_economicos', DestinoEconomicoController::class);
    Route::resource('codigo_destino_economicos', CodigoDestinoEconomicoController::class);
});

Route::middleware([
    'api',
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->prefix('api')->group(function () {
    Route::get('/predios/search', [PredioController::class, 'search'])->name('api.predios.search');
    Route::apiResource('predios', PredioController::class);

    Route::get('/predios/{predio}/historial_predios/latest', [HistorialPredioController::class, 'latest'])->name('api.predios.historial_predios.latest');
    Route::apiResource('predios.historial_predios', HistorialPredioController::class);

    Route::get('/predios/{predio}/avaluos/latest', [AvaluoController::class, 'latest'])->name('api.predios.avaluos.latest');
    Route::apiResource('predios.avaluos', AvaluoController::class);

    Route::post('/igac', [IgacParserController::class, 'store'])->name('api.igac');
});
