<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Actividad;
use App\Models\TipoCuenta;
use Illuminate\Http\Request;

class GraficoCuentaController extends Controller
{
    //
    public function index()
    {
        //Index of Cuenta
        $GraficosCuenta = Cuenta::orderBy('id','desc')->paginate(5);
        return \view('GraficoCuenta.index',compact('GraficosCuenta'));
        //$cuentas = Cuenta::orderBy('id','desc')->paginate(5);
        //$tiposCuenta = TipoCuenta::orderBy('id', 'asc')->get();
        //return \view('cuenta.index',compact('cuentas', 'tiposCuenta'));
    }
}
