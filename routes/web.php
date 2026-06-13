<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\RecetaController;

/*
|--------------------------------------------------------------------------
| Página Informativa
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {

    $credentials = $request->only(
        'email',
        'password'
    );

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    return back()->withErrors([
        'email' => 'Credenciales incorrectas.'
    ]);

})->name('login.post');

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login');

})->name('logout');

/*
|--------------------------------------------------------------------------
| Rutas protegidas
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Medicamentos
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'medicamentos',
        MedicamentoController::class
    );

    /*
    |--------------------------------------------------------------------------
    | Clientes
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'clientes',
        ClienteController::class
    );

    /*
    |--------------------------------------------------------------------------
    | Médicos
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'medicos',
        MedicoController::class
    );

    /*
    |--------------------------------------------------------------------------
    | Ventas
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/ventas',
        [VentaController::class, 'index']
    )->name('ventas.index');

    Route::post(
        '/ventas',
        [VentaController::class, 'store']
    )->name('ventas.store');

    Route::delete(
        '/ventas/{venta}',
        [VentaController::class, 'destroy']
    )->name('ventas.destroy');
    
    Route::get(
        '/ventas/comprobante/{venta}',
        [VentaController::class, 'comprobante']
    )->name('ventas.comprobante');
    /*
    |--------------------------------------------------------------------------
    | Recetas
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/recetas',
        [RecetaController::class, 'index']
    )->name('recetas.index');
});