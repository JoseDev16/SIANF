<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\TipoCuentaController;
use App\Http\Controllers\ParametrosController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\CuentaPeriodoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\SectoresController;

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

    // Ruta para los tipos de cuenta
    Route::prefix('TipoCuenta')->middleware('auth')->group(function () {

        Route::get('', [TipoCuentaController::class, 'index'])->name('tipocuenta.index');
        Route::post('', [TipoCuentaController::class, 'store'])->name('tipocuenta.store');
        Route::get('/edit/{id}', [TipoCuentaController::class, 'edit_view'])->name('tipocuenta.edit_view');
        Route::post('/edit', [TipoCuentaController::class, 'edit'])->name('tipocuenta.edit');
        Route::delete('', [TipoCuentaController::class, 'destroy'])->name('tipocuenta.destroy');

    });

    Route::prefix('RazonesFinancieras')->middleware('auth')->group(function () {

        Route::get('', [ParametrosController::class, 'index'])->name('parametros.index');
        Route::get('/edit/{id}', [ParametrosController::class, 'edit_view'])->name('parametros.edit_view');
        Route::post('/edit', [ParametrosController::class, 'edit'])->name('parametros.edit');

    });

    Route::prefix('CuentasPeriodo')->middleware('auth')->group(function () {

        Route::get('', [CuentaPeriodoController::class, 'index'])->name('cuentaperiodo.index');
        Route::post('', [CuentaPeriodoController::class, 'store'])->name('cuentaperiodo.store');
        Route::get('/edit/{id}', [CuentaPeriodoController::class, 'edit_view'])->name('cuentaperiodo.edit_view');
        Route::post('/edit', [CuentaPeriodoController::class, 'edit'])->name('cuentaperiodo.edit');
        Route::delete('', [CuentaPeriodoController::class, 'destroy'])->name('cuentaperiodo.destroy');

    });

    Route::prefix('Periodo')->middleware('auth')->group(function () {

        Route::get('', [PeriodoController::class, 'index'])->name('periodo.index');
        Route::post('', [PeriodoController::class, 'store'])->name('periodo.store');
        Route::get('/edit/{id}', [PeriodoController::class, 'edit_view'])->name('periodo.edit_view');
        Route::post('/edit', [PeriodoController::class, 'edit'])->name('periodo.edit');
        Route::delete('', [PeriodoController::class, 'destroy'])->name('periodo.destroy');

    });

    //Route::get('cuentas-excel', 'CuentaPeriodoController@store')->middleware(['auth:sanctum','verified'])->name('cuentas.store');
    Route::post('cuentas-excel', [CuentaPeriodoController::class, 'store'])->name('cuentas.store');
    
    //Ruta de las empresas
    Route::prefix('Empresa')->middleware('auth')->group(function (){

        Route::get('',[EmpresaController::class, 'index'])->name('empresa.index');        
        Route::post('',[EmpresaController::class, 'store'])->name('empresa.store');
        Route::get('/edit/{id}', [EmpresaController::class, 'edit_view'])->name('empresa.edit_view');
        Route::post('/edit', [EmpresaController::class, 'edit'])->name('empresa.edit');
        Route::delete('', [EmpresaController::class, 'destroy'])->name('empresa.destroy');
        
        Route::get('/detalle/{id}', [EmpresaController::class, 'show'])->name('empresa.show');

        // Rutas para las cuentas con middleware de autentificacion agrupadas
        Route::prefix('Cuenta')->middleware('auth')->group(function() {
            // Route::get('/', [CuentaController::class, 'index'])->name('cuenta.index')->middleware('permission:cuenta.index');

            // Ruta que devuelve las cuentas de la empresa que esta logueada o seleccionada por parte del administrador
            Route::get('/{id?}', [CuentaController::class, 'index'],
            function($empresa = null){
                return $empresa;
            })->name('cuenta.index')->middleware('permission:cuenta.index');


            Route::post('/', [CuentaController::class, 'store'])->name('cuenta.store')->middleware('permission:cuenta.store');
            Route::get('/edit/{id}', [CuentaController::class, 'edit_view'])->name('cuenta.edit_view');
            Route::post('/edit', [CuentaController::class, 'edit'])->name('cuenta.edit')->middleware('permission:cuenta.edit');
            Route::delete('/', [CuentaController::class, 'destroy'])->name('cuenta.destroy')->middleware('permission:cuenta.delete');        
        });
        
        
    });

    Route::prefix('Sectores')->middleware('auth')->group(function() {
        Route::get('', [SectoresController::class, 'index'])->name('sectores.index');
        Route::post('', [SectoresController::class, 'store'])->name('sectores.store');
        Route::get('/edit/{id}', [SectoresController::class, 'edit_view'])->name('sectores.edit_view');
        Route::post('/edit', [SectoresController::class, 'edit'])->name('sectores.edit');
        Route::delete('', [SectoresController::class, 'destroy'])->name('sectores.destroy');
    });

    Route::get('Estados', [PeriodoController::class, 'verEstados'])->middleware(['auth:sanctum','verified'])->name('estados.index');

});




