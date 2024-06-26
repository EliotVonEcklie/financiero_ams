<?php

use App\Http\Controllers\DescuentoController;
use App\Http\Controllers\DestinoEconomicoController;
use App\Http\Controllers\EstadoCuentaController;
use App\Http\Controllers\EstatutoController;
use App\Http\Controllers\EstratificacionController;
use App\Http\Controllers\FacturaMasivaController;
use App\Http\Controllers\InteresController;
use App\Http\Controllers\FacturaPredialController;
use App\Http\Controllers\PazYSalvoController;
use App\Http\Controllers\PredioEstratoController;
use App\Http\Controllers\UploadIgacController;
use App\Http\Controllers\RangoAvaluoController;
use App\Http\Controllers\UnidadMonetariaController;
use App\Http\Controllers\VigenciaUnidadMonetariaController;
use App\Http\Controllers\PredioTipoController;
use App\Http\Controllers\PrescripcionController;
use App\Http\Middleware\FinancieroAuth;
use App\Http\Middleware\SetTenantDefaultParameter;
use App\Jobs\Tasificar;
use App\Models\FacturaMasiva;
use App\Models\Predio;
use App\Models\PredioAvaluo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

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

                return to_route('tasificar.process');
            })->name('tasificar.dispatch');

            Route::get('/process', function () {
                return inertia('Tasificar/Process', [
                    'predios' => PredioAvaluo::where('tasa_por_mil', -1)->get(),
                    'prediosTasa' => PredioAvaluo::whereNot('tasa_por_mil', -1)->get()
                ]);
            })->name('tasificar.process');

            Route::resource('rango_avaluos', RangoAvaluoController::class)->withTrashed();
            Route::resource('estratificacions', EstratificacionController::class)->withTrashed();
        });

        Route::resource('upload_igac', UploadIgacController::class);
        Route::resource('estatutos', EstatutoController::class)->withTrashed();

        Route::resource('estado_cuentas', EstadoCuentaController::class)->only(['index', 'create', 'store', 'show']);
        Route::get('/factura_predials/search', [FacturaPredialController::class, 'search'])->name('factura_predials.search');
        Route::resource('factura_predials', FacturaPredialController::class)->withTrashed();
        Route::get('/paz_y_salvos/search', [PazYSalvoController::class, 'search'])->name('paz_y_salvos.search');
        Route::resource('paz_y_salvos', PazYSalvoController::class)->withTrashed();
        Route::get('/factura_masivas/{factura_masiva}/pdf', [FacturaMasivaController::class, 'show_pdf'])->name('factura_masivas.show_pdf');
        Route::get('/factura_masivas/{factura_masiva}/pdf/{resolucion}', [FacturaMasivaController::class, 'show_one_pdf'])->name('factura_masivas.show_one_pdf');
        Route::resource('factura_masivas', FacturaMasivaController::class)->withTrashed();
        Route::get('/prescripciones/search', [PrescripcionController::class, 'search'])->name('prescripciones.search');
        Route::resource('prescripciones', PrescripcionController::class)->withTrashed();

        Route::get('/prescripciones1/importInfo', [PrescripcionController::class, 'importInfo'])->name('prescripciones1.importInfo');
    });

    Route::name('public.')->group(function () {
        Route::resource('estado_cuentas', EstadoCuentaController::class)->only(['store', 'show']);
        Route::resource('factura_predials', FacturaPredialController::class)->only(['store', 'show']);
        Route::resource('prescripciones', PrescripcionController::class)->only(['store', 'show']);
        Route::resource('paz_y_salvos', PazYSalvoController::class)->only(['store', 'show']);

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

        Route::get('/impuesto_industria_comercio', function() {
            return inertia('Public/ImpuestoIndustriaComercio');
        })->name('impuesto_industria_comercio');

        Route::get('/servicios_publicos', function() {
            return inertia('Public/ServiciosPublicos');
        })->name('servicios_publicos');

        Route::get('/inscripcion', function() {
            return inertia('Public/Inscripcion');
        })->name('inscripcion');

        Route::get('/normatividad', function() {
            return inertia('Public/Normatividad');
        })->name('normatividad');

        Route::get('/notificaciones', function() {
            return inertia('Public/NotificacionesJuridicas');
        })->name('notificaciones');

        Route::get('/presentacion', function() {
            return inertia('Public/PresentacionElectronica');
        })->name('presentacion');

        Route::get('/contacto', function() {
            return inertia('Public/Contacto');
        })->name('contacto');

        Route::get('/preguntas', function() {
            return inertia('Public/PreguntasFrecuentes');
        })->name('preguntas');

        Route::get('/manuales', function() {
            return inertia('Public/ManualSistema');
        })->name('manuales');

        Route::get('/pago_confirmado', function() {
            return inertia('Public/PagoConfirmado');
        })->name('pago_confirmado');

        Route::get('/prescripciones/importInfo', [PrescripcionController::class, 'importInfo'])->name('prescripciones.importInfo');
    });
});
