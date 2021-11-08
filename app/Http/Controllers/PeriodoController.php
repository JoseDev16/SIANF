<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Models\Empresa;
use App\Models\Actividad;
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

    public function verEstados()
    {
        //
        //$empresa_id = 1;
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();

        $periodos = Periodo::where('empresa_id', '=', $empresa->id)->orderBy('id','desc')->paginate(5);
        //$tiposParametro = TipoParametros::orderBy('id','asc')->get();
        return \view('estados.index',compact('periodos'));
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
            $periodo->gastos_financieros = $request->gastos_financieros;
            $periodo->inversion_inicial = $request->inversion_inicial;
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
        $periodo->gastos_financieros = $request->gastos_financieros;
        $periodo->inversion_inicial = $request->inversion_inicial;
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
