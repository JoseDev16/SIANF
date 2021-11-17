<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Models\Empresa;
use App\Models\Actividad;
use App\Models\CuentaPeriodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodoController extends Controller
{

    public function index()
    {
        //
        //$empresa_id = 1;
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();

        $periodos = Periodo::where('empresa_id', '=', $empresa->id)->orderBy('id','asc')->paginate(5);
        //$tiposParametro = TipoParametros::orderBy('id','asc')->get();
        return \view('periodo.index',compact('periodos'));
    }

    public function verEstados(Request $request)
    {
        //
        //$empresa_id = 1;
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();

        $periodos = Periodo::where('empresa_id', '=', $empresa->id)->orderBy('id','desc')->paginate(5);

        $año = 0;
        if($request->periodo_id==null){
            $periodo_id = Periodo::join('cuenta_periodos','cuenta_periodos.periodo_id','=','periodos.id')
            ->where('empresa_id', '=', $empresa->id)->max('cuenta_periodos.periodo_id');
            $periodo = Periodo::find($periodo_id);
            $año = $periodo->year;
        } else {
            $periodo = Periodo::find($request->periodo_id);
            $periodo_id = $periodo->id;
            $año = $periodo->year;
        }

        $balancegeneral = CuentaPeriodo::join('cuentas', 'cuentas.id', '=', 'cuenta_periodos.cuenta_id')
        ->where('periodo_id', '=', $periodo_id)
        ->where(function($query){
            $query->where('cuentas.tipo_id', '=', 1)
            ->orWhere('cuentas.tipo_id', '=', 2)
            ->orWhere('cuentas.tipo_id', '=', 3);
        })
        ->get();

        $estadoresultados = CuentaPeriodo::join('cuentas', 'cuentas.id', '=', 'cuenta_periodos.cuenta_id')
        ->where('periodo_id', '=', $periodo_id)
        ->where(function($query){
            $query->where('cuentas.tipo_id', '=', 4)
            ->orWhere('cuentas.tipo_id', '=', 5)
            ->orWhere('cuentas.tipo_id', '=', 6);
        })
        ->get();

        //$tiposParametro = TipoParametros::orderBy('id','asc')->get();
        return \view('estados.index',compact('periodos', 'año', 'balancegeneral', 'estadoresultados'));
    }

    public function store(Request $request)
    {
        //Periodo::create($request->all());
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();

        $existencia = Periodo::where('year', '=', $request->year)->where('empresa_id', '=', $empresa->id)->first();
        if($existencia==null){

            $periodo = new Periodo();
            $periodo->year = $request->year;
            $periodo->acciones = $request->acciones;
            $periodo->gastos_financieros = 0;
            $periodo->inversion_inicial = 0;
            $periodo->empresa_id = $empresa->id;
            $periodo->save();

            $logs = new Actividad();
            $logs->log($request->user,'creó el periodo: '.$request->year);
            return back()->with('exito','El periodo  ha sido agregado exitosamente');
        } else {
            return back()->with('exito','El periodo ya existe');
        }
       
    }

    public function edit_view(Request $request, $id)
    {
        if($request->ajax()){
            $periodo = Periodo::find($id);
            return response()->json($periodo);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->edit_id;
        $periodo = Periodo::find($id);

        if (empty($id)) {
            return back();
        }
        $periodo->year = $request->year;
        $periodo->acciones = $request->acciones;
        //$periodo->gastos_financieros = $request->gastos_financieros;
        //$periodo->inversion_inicial = $request->inversion_inicial;
        $periodo->save();

        $logs = new Actividad();
        $logs->log($request->user,'edito el periodo '.$request->year);
        return back()->with('exito','El periodo ha sido actualizado exitosamente');
    }

    public function destroy(Request $request)
    {
        $periodo = Periodo::find($request->delete_id);
        $logs = new Actividad();
        $logs->log($request->user,'elimino el periodo '.$periodo->year);
        $periodo->delete();
        return back()->with('exito','El periodo ha sido eliminado exitosamente');
    }
}
