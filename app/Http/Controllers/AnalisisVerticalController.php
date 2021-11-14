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
