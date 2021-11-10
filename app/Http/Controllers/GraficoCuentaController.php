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
        //Muestra grafico de Cuenta
        $GraficosCuenta = Cuenta::orderBy('id','desc')->paginate(5);
        return \view('GraficoCuenta.index',compact('GraficosCuenta'));
        
    }
}
