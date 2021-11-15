<?php

namespace App\Http\Controllers;

use App\Models\CuentaPeriodo;
use App\Models\Empresa;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalisisHorizontalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    public function verAnalisisH(Request $request){

        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();

        $periodos = Periodo::where('empresa_id', '=', $empresa->id)->orderBy('id','desc')->paginate(5);

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


        $balanceAnterior = CuentaPeriodo::join('cuentas', 'cuentas.id', '=', 'cuenta_periodos.cuenta_id')
        ->where('periodo_id', '=', $periodo_id-1)
        ->where(function($query){
            $query->where('cuentas.tipo_id', '=', 1)
            ->orWhere('cuentas.tipo_id', '=', 2)
            ->orWhere('cuentas.tipo_id', '=', 3);
        })
        ->get();

        // $analisisH = array_merge($balanceAnterior,$balancegeneral);

        $estadoresultados = CuentaPeriodo::join('cuentas', 'cuentas.id', '=', 'cuenta_periodos.cuenta_id')
        ->where('periodo_id', '=', $periodo_id)
        ->where(function($query){
            $query->where('cuentas.tipo_id', '=', 4)
            ->orWhere('cuentas.tipo_id', '=', 5)
            ->orWhere('cuentas.tipo_id', '=', 6);
        })
        ->get();

        

        $estadoAnterior = CuentaPeriodo::join('cuentas', 'cuentas.id', '=', 'cuenta_periodos.cuenta_id')
        ->where('periodo_id', '=', $periodo_id-1)
        ->where(function($query){
            $query->where('cuentas.tipo_id', '=', 4)
            ->orWhere('cuentas.tipo_id', '=', 5)
            ->orWhere('cuentas.tipo_id', '=', 6);
        })
        ->get();

        // dd($estadoAnterior);
        
        //$tiposParametro = TipoParametros::orderBy('id','asc')->get();
        return \view('analisisHorizontal.index',compact('periodos', 'año', 'balancegeneral', 'estadoresultados', 
        'balanceAnterior', 'estadoAnterior'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
