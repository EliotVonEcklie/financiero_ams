<?php

declare(strict_types=1);

use App\Http\Controllers\DestinoEconomicoController;
use App\Http\Controllers\HistorialPredioController;
use App\Http\Controllers\AvaluoController;
use App\Http\Controllers\CodigoDestinoEconomicoController;
use App\Http\Controllers\EstratificacionController;
use App\Http\Controllers\PredioController;
use App\Http\Controllers\PredioEstratoController;
use App\Http\Controllers\UploadIgacController;
use App\Http\Controllers\RangoAvaluoController;
use App\Http\Controllers\UnidadMonetariaController;
use App\Http\Controllers\VigenciaUnidadMonetariaController;
use App\Http\Controllers\PredioTipoController;
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

    Route::resource('upload_igac', UploadIgacController::class);

    Route::resource('destino_economicos', DestinoEconomicoController::class)->withTrashed();
    Route::resource('vigencia_unidad_monetarias', VigenciaUnidadMonetariaController::class)->withTrashed();
    Route::resource('rango_avaluos', RangoAvaluoController::class)->withTrashed();
    Route::resource('predio_estratos', PredioEstratoController::class)->withTrashed();
    Route::resource('estratificaciones', EstratificacionController::class)->withTrashed();

    Route::resource('unidad_monetarias', UnidadMonetariaController::class)->withTrashed();
    Route::resource('predio_tipos', PredioTipoController::class)->withTrashed();
});
/*
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
});
*/
