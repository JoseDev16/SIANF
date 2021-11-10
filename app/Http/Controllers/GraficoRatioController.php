<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Razon;
use App\Models\Cuenta;
use App\Models\TipoCuenta;
use Illuminate\Http\Request;

class GraficoRatioController extends Controller
{
    // Mostrando datos en pantalla
    public function index()
    {
        //Muestra grafico de ratios
        $GraficosRatio = Cuenta::orderBy('id','desc')->paginate(5);
        return \view('GraficoRatio.index',compact('GraficosRatio'));
        
    }
}
