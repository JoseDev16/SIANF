<?php

namespace App\Http\Controllers;

use App\Models\CuentaPeriodo;
use App\Models\Periodo;
use Illuminate\Http\Request;

class CuentaPeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $empresa_id = 1;
        $periodos = Periodo::where('empresa_id', '=', $empresa_id)->orderBy('id','asc')->get();
        //$tiposParametro = TipoParametros::orderBy('id','asc')->get();
        return \view('cuentaperiodo.index',compact('periodos'));
    }

    public function importExcel(){
        
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
     * @param  \App\Models\CuentaPeriodo  $cuentaPeriodo
     * @return \Illuminate\Http\Response
     */
    public function show(CuentaPeriodo $cuentaPeriodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CuentaPeriodo  $cuentaPeriodo
     * @return \Illuminate\Http\Response
     */
    public function edit(CuentaPeriodo $cuentaPeriodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CuentaPeriodo  $cuentaPeriodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CuentaPeriodo $cuentaPeriodo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CuentaPeriodo  $cuentaPeriodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuentaPeriodo $cuentaPeriodo)
    {
        //
    }
}
