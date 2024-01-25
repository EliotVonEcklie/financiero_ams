<?php

use App\Http\Controllers\DescuentoController;
use App\Http\Controllers\DestinoEconomicoController;
use App\Http\Controllers\EstadoCuentaController;
use App\Http\Controllers\EstatutoController;
use App\Http\Controllers\EstratificacionController;
use App\Http\Controllers\InteresController;
use App\Http\Controllers\FacturaPredialController;
use App\Http\Controllers\PredioEstratoController;
use App\Http\Controllers\UploadIgacController;
use App\Http\Controllers\RangoAvaluoController;
use App\Http\Controllers\UnidadMonetariaController;
use App\Http\Controllers\VigenciaUnidadMonetariaController;
use App\Http\Controllers\PredioTipoController;
use App\Http\Middleware\FinancieroAuth;
use App\Http\Middleware\SetTenantDefaultParameter;
use App\Jobs\Tasificar;
use App\Models\Predio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
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

Route::group([
    'prefix' => '/{tenant}',
    'middleware' => [
        'web',
        InitializeTenancyByPath::class,
        SetTenantDefaultParameter::class
    ]
], function () {
    Route::prefix('/financiero')->middleware(FinancieroAuth::class)->group(function () {
        Route::get('/login', function () {
            return inertia('Login');
        })->withoutMiddleware(FinancieroAuth::class)->name('login');

        Route::get('/test', function () {
            return Pdf::loadView('pdf.private.test')->stream();
        })->name('test');

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
            Route::resource('interes', InteresController::class)->withTrashed();
            Route::resource('descuentos', DescuentoController::class)->withTrashed();
        });

        Route::prefix('tasificar')->group(function () {
            Route::get('/', function () {
                return inertia('Tasificar/Index');
            })->name('tasificar.index');

            Route::get('/dispatch', function () {
                Tasificar::dispatch();

                return to_route('tasificar.index');
            })->name('tasificar.dispatch');

            Route::resource('rango_avaluos', RangoAvaluoController::class)->withTrashed();
            Route::resource('estratificacions', EstratificacionController::class)->withTrashed();
        });

        Route::resource('upload_igac', UploadIgacController::class);
        Route::resource('estatutos', EstatutoController::class)->withTrashed();
        Route::resource('estado_cuentas', EstadoCuentaController::class)->only(['index', 'create', 'store', 'show']);
    });

    Route::name('public.')->group(function () {
        Route::get('/', function () {
            return inertia('Public/Index');
        })->name('index');

        Route::get('/impuesto_predial_unificado', function (Request $request) {
            if ($request->has('search') && $request->query('search') !== null && $request->query('search') !== '') {
                $predios = Predio::search($request->query('search'));
            }

            if ($request->has('predio_id') && $request->query('predio_id') !== null && $request->query('predio_id') !== '') {
                $predio = Predio::show($request->query('predio_id'));
            }

            return inertia('Public/ImpuestoPredialUnificado', [
                'predios' => $predios ?? [],
                'predio' => $predio ?? []
            ]);
        })->name('impuesto_predial_unificado');

        Route::get('/inscripcion',function(){
            return inertia('Public/Inscripcion');
        })->name('inscripcion');

        Route::resource('estado_cuentas', EstadoCuentaController::class)->only(['store', 'show']);
        Route::resource('factura_predials', FacturaPredialController::class)->only(['store', 'show']);
    });
});
