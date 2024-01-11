<?php

declare(strict_types=1);

use App\Http\Controllers\DestinoEconomicoController;
use App\Http\Controllers\EstatutoController;
use App\Http\Controllers\EstratificacionController;
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
        return inertia('Index');
    })->name('index');

    Route::prefix('parametros')->group(function () {
        Route::get('/', function () {
            return inertia('Parametros/Index');
        })->name('parametros.index');

        Route::resource('destino_economicos', DestinoEconomicoController::class)->withTrashed();
        Route::resource('unidad_monetarias', UnidadMonetariaController::class)->withTrashed();
        Route::resource('vigencia_unidad_monetarias', VigenciaUnidadMonetariaController::class)->withTrashed();
        Route::resource('predio_tipos', PredioTipoController::class)->withTrashed();
        Route::resource('predio_estratos', PredioEstratoController::class)->withTrashed();
    });

    Route::prefix('tasificar')->group(function () {
        Route::get('/', function () {
            return inertia('Tasificar/Index');
        })->name('tasificar.index');

        Route::resource('rango_avaluos', RangoAvaluoController::class)->withTrashed();
        Route::resource('estratificacions', EstratificacionController::class)->withTrashed();
    });

    Route::resource('upload_igac', UploadIgacController::class);
    Route::resource('estatutos', EstatutoController::class)->withTrashed();
});
