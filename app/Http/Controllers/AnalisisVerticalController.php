<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnalisisVerticalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();
        $periodos =Periodo::where('empresa_id', $empresa->id)->get();
        return view('analisisVertical.index', compact('periodos'));
        // return \view('cuenta.index',compact('cuentas', 'tiposCuenta'));
        // $periodos=Periodo::Where('empresa_id',$empresa->id)->get();
        // return view('finanzasViews.analisisSector.analisis_vertical',['periodos'=>$periodos]);

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
    public function show($id_periodo)
    {
        //
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();
        if(!$periodo = Periodo::Where('id', $id_periodo)->Where('empresa_id', $empresa->id)->first())
            abort(503);

        $periodos=Periodo::Where('empresa_id', $empresa->id)->get();

        // $activo=DB::table('cuentas')
        // ->join('')
        
        // $periodos=Periodo::Where('empresa_id',$empresa->id)->get();
        // //Traer las vincuncalicones de Activo, pasivo y capital
        // $activo=DB::select('select c.*, cp.total from (select * from cuenta 
        // where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
        // and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        // left join (select * from cuenta_periodo where periodo_id=?) as cp
        // on c.id= cp.cuenta_id',[$empresa->id, 'Activos', $id_periodo]);

        // $pasivo=DB::select('select c.*, cp.total from (select * from cuenta 
        // where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
        // and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        // left join (select * from cuenta_periodo where periodo_id=?) as cp
        // on c.id= cp.cuenta_id',[$empresa->id, 'Pasivos', $id_periodo]);

        // $capital=DB::select('select c.*, cp.total from (select * from cuenta 
        // where id=(select id_cuenta from vinculacion_cuenta where id_empresa=? 
        // and id_cuenta_sistema=(select id from cuenta_sistema where nombre=?))) as c
        // left join (select * from cuenta_periodo where periodo_id=?) as cp
        // on c.id= cp.cuenta_id',[$empresa->id, 'Patrimonio', $id_periodo]);
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
