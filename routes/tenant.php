<?php

declare(strict_types=1);

use App\Http\Controllers\DestinoEconomicoController;
use App\Http\Controllers\HistorialPredioController;
use App\Http\Controllers\AvaluoController;
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
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/destino_economicos', [DestinoEconomicoController::class, 'indexAdmin'])->name('admin.destino_economicos.index');
        Route::get('/destino_economicos/{destino_economico}', [DestinoEconomicoController::class, 'showAdmin'])->name('admin.destino_economicos.show');
    
        Route::get('/predios', [PredioController::class, 'indexAdmin'])->name('admin.predios.index');
        Route::get('/predios/{predio}', [PredioController::class, 'showAdmin'])->name('admin.predios.show');
        Route::get('/predios/{predio}/historial_predios', [HistorialPredioController::class, 'indexAdmin'])->name('admin.predios.historial_predios.index');
        Route::get('/predios/{predio}/avaluos', [AvaluoController::class, 'indexAdmin'])->name('admin.predios.avaluos.index');
    
        Route::get('/test_igac', [IgacParserController::class, 'create'])->name('admin.test_igac');
    });
    
    Route::get('/predios', function () { view('app.predios'); })->name('app.predios');
});

Route::middleware([
    'api',
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->prefix('api')->group(function () {
    Route::apiResource('destino_economicos', DestinoEconomicoController::class);

    Route::get('/predios/search', [PredioController::class, 'search'])->name('api.predios.search');
    Route::apiResource('predios', PredioController::class);
    
    Route::get('/predios/{predio}/historial_predios/latest', [HistorialPredioController::class, 'latest'])->name('api.predios.historial_predios.latest');
    Route::apiResource('predios.historial_predios', HistorialPredioController::class);
    
    Route::get('/predios/{predio}/avaluos/latest', [AvaluoController::class, 'latest'])->name('api.predios.avaluos.latest');
    Route::apiResource('predios.avaluos', AvaluoController::class);
    
    Route::post('/igac', [IgacParserController::class, 'store'])->name('api.igac');
});