<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Razon;
use App\Models\Cuenta;
use App\Models\Periodo;
use App\Models\Empresa;
use App\Models\TipoCuenta;
use App\Models\Parametros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GraficoRatioController extends Controller
{
    // Mostrando datos en pantalla
    public function index()
    {
        //Muestra grafico de ratios
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();
        $Periodo = Periodo::where('empresa_id', '=', $empresa->id)->orderBy('id','desc')->get();
        $GraficosRatio = Cuenta::orderBy('id','desc')->paginate(5);
        //$parametro= Parametros::orderBy('id','desc')->get();

        return \view('GraficoRatio.index',compact('GraficosRatio','Periodo'));
        
    }

     public function verGrafRazones(Request $request)
    {
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();
        $periodos = Periodo::where('empresa_id', '=', $empresa->id)->orderBy('id','desc')->get();

        //$periodo = 0;
        if ($request->periodo_final==null || $request->periodo_inicio==null || $request->ratio_id==null){
            // no hacer consulta de grafico, sino tambien pueden
            // hacer una consulta de los dos ultimos periodos con la funcion max

            
            $año1 = 0;
            $año2 = 0;
            $id_ratio = 0;

        } else {
            // hacer consulta de grafico utilizando estas variables:
            $año2 = Periodo::find($request->periodo_final)->year;
            $año1 = Periodo::find($request->periodo_inicio)->year;
            $id_ratio = $request->ratio_id;
        }
        $ratios = Razon::join('parametros', 'parametros.id', '=', 'razons.parametro_id')
            ->join('periodos', 'periodos.id', '=','razons.periodo_id')
            ->where('parametros.id', '=', $id_ratio)
            ->whereBetween('periodos.year', [$año1, $año2])->get();

        $parametro= Parametros::orderBy('id','desc')->get();

        //return $ratios;
        return \view('GraficoRatio.index',compact('periodos', 'ratios', 'año1','año2','parametro'));
    }
}
