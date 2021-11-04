<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\TipoCuenta;

class TipoCuentaController extends Controller
{
   /* public function __construct()
    {
         $this->tipoCuentas = new TipoCuenta();

    }*/

    public function index()
    {
        $tipoCuentas = TipoCuenta::orderBy('id','desc')->paginate(5);
        return \view('tipoCuenta.index',compact('tipoCuentas'));
    }

    public function store(Request $request)
    {
        TipoCuenta::create($request->all());
        $logs = new Actividad();
        $logs->log($request->user,'crear el tipo cuenta: '.$request->nombre);
        return back()->with('exito','El tipo de Cuenta  ha sido agregada exitosamente');
    }

    public function edit_view(Request $request, $id)
    {
        if($request->ajax()){
            $tipoCuenta = TipoCuenta::find($id);
            return response()->json($tipoCuenta);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->edit_id;
        $tipoCuenta = TipoCuenta::find($id);

        if (empty($id)) {
            return back();
        }
        $tipoCuenta->nombre = $request->nombre;
        $tipoCuenta->save();
        $logs = new Actividad();
        $logs->log($request->user,'edito la tipoCuenta '.$request->nombre);
        return back()->with('exito','La tipoCuenta ha sido actualizada exitosamente');
    }

    public function destroy(Request $request)
    {
        $tipoCuenta = TipoCuenta::find($request->delete_id);
        $logs = new Actividad();
        $logs->log($request->user,'elimino la tipoCuenta '.$tipoCuenta->nombre);
        $tipoCuenta->delete();
        return back()->with('exito','La tipoCuenta ha sido eliminada exitosamente');
    }
}
