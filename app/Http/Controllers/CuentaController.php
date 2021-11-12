<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Cuenta;
use App\Models\Empresa;
use App\Models\TipoCuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idUsuario = Auth::id();
        if($idUsuario>1){
            $empresa = Empresa::where('user_id', '=', $idUsuario)->first();

            
            //Index of Cuenta
            // $cuentas = Cuenta::where('empresa_id', '=', $empresa->id)->orderBy('id','asc')->paginate(5);
            // $cuentas = DB::table('cuentas')
            // ->join('empresas', 'empresas.id', '=', 'cuentas.empresa_id')
            // ->select('id','nombre','codigo','tipo_id');

            $cuentas = Cuenta::orderBy('id','desc')->paginate(5);
            $tiposCuenta = TipoCuenta::orderBy('id', 'asc')->get();
            return \view('cuenta.index',compact('cuentas', 'tiposCuenta'));
        }
        else{

        }
        

        // $empresa = DB::table('empresas')->join('cuentas', 'cuentas.empresa_id', '=', 'enmpresas.id')
        // ->select('id','nombre','codigo','empresa_id', 'tipo_id');

        // $cuentas = DB::table('cuentas')
        
        // ->join('empresas', 'empresas.id', '=', 'cuenta.empresa_id')
        // ->select('nombre','codigo','tipo_id','empresa_id')
        // ->get();

        
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
        //Agrega la cuenta a la empresa
        $idUsuario = Auth::id();
        $empresa = Empresa::where('user_id', '=', $idUsuario)->first();
        
        //Objeto de cuenta
        $cuenta = New Cuenta();
        $cuenta->codigo = $request->codigo;
        $cuenta->nombre = $request->nombre;
        $cuenta->empresa_id = $empresa->id;
        $cuenta->tipo_id = $request->tipo_id;
        $cuenta->save();

        $logs = new Actividad();
        $logs->log($request->user,'crear el tipo cuenta: '.$request->nombre);
        return back()->with('exito','La cuenta ha sido agregada exitosamente');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */

    /* 
        This function works hand by hand with the blade so if we gonna need to add some 
        parameters is better to put in the index blade 
    */
    public function edit_view(Request $request, $id)
    {
        if($request->ajax()){
            $cuentas = Cuenta::find($id);
            return response()->json($cuentas);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //Edit cuentas
        $id = $request->edit_id;
        $tipoCuenta = Cuenta::find($id);

        if (empty($id)) {
            return back();
        }

        //Adding the parameters from the request
        $tipoCuenta->nombre = $request->nombre;
        $tipoCuenta->codigo = $request->codigo;
        $tipoCuenta->tipo_id = $request->tipo_id;
        $tipoCuenta->save();
        $logs = new Actividad();
        $logs->log($request->user,'edito la tipoCuenta '.$request->nombre);
        return back()->with('exito','La tipoCuenta ha sido actualizada exitosamente');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuenta $cuenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Elimina la cuenta
        $tipoCuenta = Cuenta::find($request->delete_id);
        $logs = new Actividad();
        $logs->log($request->user,'elimino la tipoCuenta '.$tipoCuenta->nombre);
        $tipoCuenta->delete();
        return back()->with('exito','La tipoCuenta ha sido eliminada exitosamente');
    }
}
