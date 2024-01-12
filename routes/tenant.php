<?php

declare(strict_types=1);

use App\Http\Controllers\DestinoEconomicoController;
use App\Http\Controllers\EstatutoController;
use App\Http\Controllers\EstratificacionController;
use App\Http\Controllers\PredioController;
use App\Http\Controllers\PredioEstratoController;
use App\Http\Controllers\UploadIgacController;
use App\Http\Controllers\RangoAvaluoController;
use App\Http\Controllers\UnidadMonetariaController;
use App\Http\Controllers\VigenciaUnidadMonetariaController;
use App\Http\Controllers\PredioTipoController;
use App\Models\Predio;
use Illuminate\Http\Request;
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
    Route::prefix('/financiero')->group(function () {
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

    Route::name('public.')->group(function () {
        Route::get('/', function () {
            return inertia('Public/Index');
        })->name('index');

        Route::get('/search_test', function (Request $request) {
            $query = $request->query('search');

            $predios = Predio::search($query);

            return response()->json($predios);
        });

        Route::get('/impuesto_predial_unificado', function (Request $request) {
            if ($request->has('search')) {
                $predios = Predio::search($request->query('search'));
            }

            if ($request->has('predio_id')) {
                $predio = Predio::find($request->query('predio_id'));
            }

            return inertia('Public/ImpuestoPredialUnificado', [
                'predios' => $predios ?? [],
                'predio' => $predio ?? []
            ]);
        })->name('impuesto_predial_unificado');

        Route::get('/predio', [PredioController::class, 'show'])->name('predio');
    });
});
