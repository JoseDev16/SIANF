<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Razon;
use App\Models\Cuenta;
use App\Models\CuentaPeriodo;
use App\Models\Periodo;
use App\Models\Empresa;
use App\Models\TipoCuenta;
use App\Models\Parametros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GraficoCuentaController extends Controller
{
    // Mostrando datos en pantalla
    public function index()
    {
        //Muestra grafico de cuentas
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();
        $Periodo = Periodo::where('empresa_id', '=', $empresa->id)->orderBy('id','desc')->get();
        $GraficosCuenta = Cuenta::orderBy('id','desc')->paginate(5);

        return \view('GraficoCuenta.index',compact('GraficosCuenta','Periodo'));
        
    }

     public function verGrafCuentas(Request $request)
    {
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();
        $periodos = Periodo::where('empresa_id', '=', $empresa->id)->orderBy('id','desc')->get();

        if ($request->periodo_final==null || $request->periodo_inicio==null || $request->cuenta_id==null){

            $año1 = 0;
            $año2 = 0;
            $id_cuenta = 0;

        } else {
            // hacer consulta de grafico utilizando estas variables:
            $año2 = Periodo::find($request->periodo_final)->year;
            $año1 = Periodo::find($request->periodo_inicio)->year;
            $id_cuenta = $request->cuenta_id;
        }
        $cuentaPeriodo = CuentaPeriodo::join('cuentas', 'cuentas.id', '=', 'cuenta_periodos.cuenta_id')
            ->join('periodos', 'periodos.id', '=','cuenta_periodos.periodo_id')
            ->where('cuentas.id', '=', $id_cuenta)
            ->whereBetween('periodos.year', [$año1, $año2])->get();

        $cuentas= Cuenta::orderBy('id','desc')->get();

        //return $cuentaPeriodo;
        return \view('GraficoCuenta.index',compact('periodos', 'cuentaPeriodo', 'año1','año2','cuentas'));
    }
}
