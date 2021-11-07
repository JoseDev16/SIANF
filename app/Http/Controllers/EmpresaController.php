<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;
use App\Models\Sector;

class EmpresaController extends Controller
{
    //
    public function index()
    {

        $tipoEmpresas = Empresa::orderBy('id','desc')->paginate(5);
        $sectores = Sector::orderBy('id','desc')->paginate(5);
        return \view('tipoEmpresa.index',compact('tipoEmpresas','sectores'));
    }

    public function store(Request $request)
    {
        Empresa::create($request->all());
        $logs = new Actividad();
        $logs->log($request->user,'crear el tipo de empresa: '.$request->nombre);

        return back()->with('exito','El tipo de Empresa ha sido agregado exitosamente');
    }

    public function edit_view(Request $request, $id)
    {
        if($request->ajax()){
            $tipoEmpresas = Empresa::find($id);
            return response()->json($tipoEmpresas);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->edit_id;
        $tipoEmpresas = Empresa::find($id);

        if (empty($id)) {
            return back();
        }
        $tipoEmpresas->nombre = $request->nombre;
        $tipoEmpresas->nit = $request->nit;
        $tipoEmpresas->nrc = $request->nrc;
        $tipoEmpresas->sector_id = $request->sector_id;

        $tipoEmpresas->save();
        $logs = new Actividad();
        $logs->log($request->user,'edito el tipo de empresa '.$request->nombre);
        return back()->with('exito','La empresa ha sido actualizada exitosamente');
    }

    public function destroy(Request $request)
    {
        $empre = Empresa::find($request->delete_id);
        $logs = new Actividad();
        $logs->log($request->user,'elimino la empresa '.$empre->nombre);
        $empre->delete();
        return back()->with('exito','La empresa ha sido eliminada exitosamente');
    }

}
