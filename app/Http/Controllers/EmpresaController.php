<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Empresa;
use App\Models\Sector;

class EmpresaController extends Controller
{
    //
    public function index()
    {
        $tipoEmpresas = Empresa::orderBy('id','desc')->paginate(5);
        return \view('tipoEmpresa.index',compact('tipoEmpresas'));
    }

    public function store(Request $request)
    {
        Empresa::create($request->all());
        $logs = new Actividad();
        $logs->log($request->user,'crear el tipo de empresa: '.$request->nombre);

        $sectores = DB::table('empresas')
        ->join ('sectors','empresas.sector_id','=','sector.id')
        ->where ('empresas.sector_id','=', Auth::id())
        ->select('empresas.sector_id')
        ->get();

        return back()->with('exito','El tipo de Empresa ha sido agregado exitosamente')
        ->with('sectores',$sectores);
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
