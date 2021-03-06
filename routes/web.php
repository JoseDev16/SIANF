<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AnalisisHorizontalController;
use App\Http\Controllers\AnalisisVerticalController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\TipoCuentaController;
use App\Http\Controllers\ParametrosController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\CuentaPeriodoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\SectoresController;
use App\Http\Controllers\GraficoCuentaController;
use App\Http\Controllers\GraficoRatioController;
use App\Http\Controllers\RazonController;


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


    // Rutas para las cuentas con middleware de autentificacion agrupadas
    Route::prefix('Cuentas')->middleware('auth')->group(function () {
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

    Route::prefix('Empresa')->middleware('auth')->group(function () {

        Route::get('', [EmpresaController::class, 'index'])->name('empresa.index');
        Route::post('', [EmpresaController::class, 'store'])->name('empresa.store');
        Route::get('/edit/{id}', [EmpresaController::class, 'edit_view'])->name('empresa.edit_view');
        Route::post('/edit', [EmpresaController::class, 'edit'])->name('empresa.edit');
        Route::delete('', [EmpresaController::class, 'destroy'])->name('empresa.destroy');
    });

    Route::prefix('Sectores')->middleware('auth')->group(function () {
        Route::get('', [SectoresController::class, 'index'])->name('sectores.index');
        Route::post('', [SectoresController::class, 'store'])->name('sectores.store');
        Route::get('/edit/{id}', [SectoresController::class, 'edit_view'])->name('sectores.edit_view');
        Route::post('/edit', [SectoresController::class, 'edit'])->name('sectores.edit');
        Route::delete('', [SectoresController::class, 'destroy'])->name('sectores.destroy');
    });

    Route::get('EstadosFinancieros', [PeriodoController::class, 'verEstados'])->middleware(['auth:sanctum', 'verified'])->name('estados.index');

    Route::prefix('Razones')->middleware('auth')->group(function () {
        Route::get('', [RazonController::class, 'index'])->name('razon.index');
        Route::post('', [RazonController::class, 'store'])->name('razon.store');
        Route::get('/edit/{id}', [RazonController::class, 'edit_view'])->name('razon.edit_view');
        Route::post('/edit', [RazonController::class, 'edit'])->name('razon.edit');
        Route::delete('', [RazonController::class, 'destroy'])->name('razon.destroy');
    });

    Route::get('VerRatios', [RazonController::class, 'verRazones'])->middleware(['auth:sanctum', 'verified'])->name('verratios.index');
    Route::get('PromedioEmpresarial', [RazonController::class, 'verPromedio'])->middleware(['auth:sanctum', 'verified'])->name('verpromedio.index');
    Route::get('comparacion', [RazonController::class, 'compareYearsView'])->name('razon.comparacion');
    Route::get('comparacionSector', [RazonController::class, 'compareSectorView'])->name('razon.comparacionSectorView');
    Route::get('VerRatios', [RazonController::class, 'verRazones'])->middleware(['auth:sanctum', 'verified'])->name('verratios.index');
    Route::get('PromedioEmpresarial', [RazonController::class, 'verPromedio'])->middleware(['auth:sanctum', 'verified'])->name('verpromedio.index');

    Route::get('VerGrafRatios', [GraficoRatioController::class, 'verGrafRazones'])->middleware(['auth:sanctum', 'verified'])->name('grafratios.index');


    /*------------------------------------------- ANALISIS-VERTICAL-------------------------------------------*/
	
	Route::get('/analisis_vertical', [AnalisisVerticalController::class, 'index'])->name('analisis.vertical');    		

    /*------------------------------------------- ANALISIS-HORIZONTAL -------------------------------------------*/
    
    Route::get('/analisis_horizontal', [AnalisisHorizontalController::class, 'verAnalisisH'])->name('analisis.horizontal');


    Route::get('VerGrafRatios', [GraficoRatioController::class, 'verGrafRazones'])->middleware(['auth:sanctum','verified'])->name('grafratios.index');
    Route::get('VerGrafCuentas', [GraficoCuentaController::class, 'verGrafCuentas'])->middleware(['auth:sanctum', 'verified'])->name('grafcuentas.index');


    // });



    Route::post('comparacionyears', [RazonController::class, 'compareYears'])->name('razon.comparacionYears');
    Route::post('comparacionSector', [RazonController::class, 'compareSector'])->name('razon.comparacionSector');

    Route::get('comparacionValor', [RazonController::class, 'compareValorView'])->name('razon.comparacionValorView');
    Route::post('comparacionValor', [RazonController::class, 'compareValor'])->name('razon.comparacionValor');
});
