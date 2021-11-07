<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoParametros;
use App\Models\Parametros;

class ParametrosController extends Controller
{
   /* public function __construct()
    {
         $this->tipoCuentas = new TipoCuenta();

    }*/

    public function index()
    {
        $razones = Parametros::orderBy('id','asc')->paginate(5);
        $tiposParametro = TipoParametros::orderBy('id','asc')->get();
        return \view('parametros.index',compact('tiposParametro', 'razones'));
    }

    public function store(Request $request)
    {
       
    }

    public function edit_view(Request $request, $id)
    {
        if($request->ajax()){
            $razon = Parametros::find($id);
            return response()->json($razon);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->edit_id;
        $razon = Parametros::find($id);

        if (empty($id)) {
            return back();
        }
        $razon->valor = $request->valor;
        $razon->tipo_id = $request->tipo_id;
        $razon->mayor = $request->mayor;
        $razon->menor = $request->menor;
        $razon->entre = $request->entre;

        $razon->save();
        $logs = new Actividad();
        $logs->log($request->user,'edito el parametro '.$request->parametro);
        return back()->with('exito','La Razon ha sido actualizada exitosamente');
    }

    public function destroy(Request $request)
    {
        
    }
}
