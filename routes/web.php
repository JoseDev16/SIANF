<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\TipoCuentaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->get('/', function () {
    return view('base');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', [UserController::class, 'index'])->name('dashboard');


//Rutas para usuario

Route::middleware(['auth'])->group(function () {
    //Rutas usuarios
    Route::get('/usuarios/detalle/{id}', [UserController::class, 'show'])->name('user.show')->middleware('permission:user.create');
    Route::get('/usuarios', [UserController::class, 'index'])->name('user.index');
    Route::get('/usuarios/editar/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('permission:user.edit');
    Route::get('/usuarios/updatePassword/{id}', [UserController::class, 'getPassword'])->name('user.updatePassword')->middleware('permission:user.updatePassword');
    Route::post('/usuarios/updatePassword/{id}', [UserController::class, 'updatePassword'])->name('user.updatePasswordPost')->middleware('permission:user.updatePasswordPost');
    Route::delete('Usuarios/delete', [UserController::class, 'destroy'])->name('user.delete');
    Route::post('/usuarios/update/{id}', [UserController::class, 'update'])->name('user.update')->middleware('permission:user.update');

    Route::get('/usuarios/getroles/{id}', [UserController::class, 'getRoles'])->name('user.getRoles')->middleware('permission:user.getRoles');
    Route::post('/usuarios/setroles', [UserController::class, 'setRoles'])->name('user.setRoles')->middleware('permission:user.setRoles');
    Route::delete('/usuarios/detroles', [UserController::class, 'deleteRoles'])->name('user.deleteRoles')->middleware('permission:user.deleteRoles');


    //Rutas para ROL
    Route::get('/roles', [RolController::class, 'index'])->name('rol.index')->middleware('permission:rol.index');
    Route::post('/roles', [RolController::class, 'index'])->name('rol.index')->middleware('permission:rol.index');
    Route::post('/roles/store', [RolController::class, 'store'])->name('rol.store')->middleware('permission:rol.store');
    Route::get('/roles/editar/{id}', [RolController::class, 'edit'])->name('rol.edit')->middleware('permission:rol.edit');
    Route::post('/roles/editar/update', [RolController::class, 'update'])->name('rol.update')->middleware('permission:rol.update');
    Route::delete('roles/delete', [RolController::class, 'destroy'])->name('rol.delete')->middleware('permission:rol.delete');

    //Rutas para logs
    Route::get('/logs', [ActividadController::class, 'index'])->name('logs.index')->middleware('permission:logs.index');

    Route::prefix('Cuentas')->middleware('auth')->group(function() {
        Route::get('', [CuentaController::class, 'index'])->name('cuenta.index');
        Route::post('', [CuentaController::class, 'store'])->name('cuenta.store');
        Route::get('/edit/{id}', [CuentaController::class, 'edit_view'])->name('cuenta.edit_view');
        Route::post('/edit', [CuentaController::class, 'edit'])->name('cuenta.edit');
        Route::delete('', [CuentaController::class, 'destroy'])->name('cuenta.destroy');
    });

    Route::prefix('TipoCuenta')->middleware('auth')->group(function () {

        Route::get('', [TipoCuentaController::class, 'index'])->name('tipocuenta.index');
        Route::post('', [TipoCuentaController::class, 'store'])->name('tipocuenta.store');
        Route::get('/edit/{id}', [TipoCuentaController::class, 'edit_view'])->name('tipocuenta.edit_view');
        Route::post('/edit', [TipoCuentaController::class, 'edit'])->name('tipocuenta.edit');
        Route::delete('', [TipoCuentaController::class, 'destroy'])->name('tipocuenta.destroy');

    });
});




