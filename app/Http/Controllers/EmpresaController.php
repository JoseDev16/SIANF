<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Empresa;

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
        return back()->with('exito','El tipo de Empresa ha sido agregado exitosamente');
    }

}
