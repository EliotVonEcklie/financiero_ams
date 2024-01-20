<?php

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

Route::get('/setup_municipio', function (Request $request) {
    if ($request->input('app_key') == env('APP_KEY')) {
        return inertia('SetupMunicipio', ['app_key' => $request->input('app_key')]);
    } else {
        return response()->file(resource_path('img/burro.png'));
    }
});

Route::post('/setup_municipio', function (Request $request) {
    if ($request->input('app_key') == env('APP_KEY')) {
        $data = $request->all();

        \App\Models\Tenant::create([
            'tenancy_db_name' => $data['db_name'],
            'tenancy_db_username' => $data['db_username'],
            'tenancy_db_password' => $data['db_password'],
            'nombre' => $data['nombre'],
            'nit' => $data['nit'],
            'lema' => $data['lema'],
            'imagen' => base64_encode($request->file('imagen')->get()),
            'direccion' => $data['direccion'],
            'entidad' => $data['entidad'],
            'correo' => $data['correo'],
            'pagina' => $data['pagina']
        ])->domains()->create([
            'domain' => $data['domain']
        ]);

        return redirect(tenant_route($data['domain'], 'index'));
    } else {
        return response()->file(public_path('img/burro.png'));
    }
})->name('setup_municipio');
