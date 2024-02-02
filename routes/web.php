<?php

use App\Http\Middleware\FinancieroCentralAuth;
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

Route::middleware(FinancieroCentralAuth::class)->group(function () {
    Route::get('/setup_municipio', function (Request $request) {
        $tenant = \App\Models\Tenant::find($request->input('tenant_id'));

        if ($tenant) {
            $tenant = [
                'domain' => $tenant->id,
                'db_name' => $tenant->tenancy_db_name,
                'db_username' => $tenant->tenancy_db_username,
                'db_password' => $tenant->tenancy_db_password,
                'nombre' => $tenant->nombre,
                'nit' => $tenant->nit,
                'lema' => $tenant->lema,
                'imagen' => $tenant->imagen,
                'direccion' => $tenant->direccion,
                'entidad' => $tenant->entidad,
                'correo' => $tenant->correo,
                'pagina' => $tenant->pagina,
                'telefono' => $tenant->telefono,
            ];
        }

        return inertia('SetupMunicipio', [
            'app_key' => $request->input('app_key'),
            'tenant' => $tenant
        ]);
    });

    Route::post('/setup_municipio', function (Request $request) {
        $data = $request->all();

        \App\Models\Tenant::updateOrCreate([
            'id' => $data['domain']
        ], [
            'tenancy_db_name' => $data['db_name'],
            'tenancy_db_username' => $data['db_username'],
            'tenancy_db_password' => $data['db_password'],
            'nombre' => $data['nombre'],
            'nit' => $data['nit'],
            'lema' => $data['lema'],
            'imagen' => base64_encode($request->file('imagen')->get()),
            'direccion' => $data['direccion'] ?? '',
            'entidad' => $data['entidad'] ?? '',
            'correo' => $data['correo'] ?? '',
            'pagina' => $data['pagina'] ?? ''
        ]);

        return to_route('index', ['tenant' => $data['domain']]);
    })->name('setup_municipio');
});
