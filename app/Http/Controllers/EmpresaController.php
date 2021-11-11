<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmpresaController extends Controller
{
    //
    public function index()
    {

        $empresas = Empresa::orderBy('id','asc')
        ->paginate(5);
        $sectores = Sector::orderBy('id','asc')->paginate(5);
        return \view('empresa.index',compact('empresas','sectores'));
    }

    public function store(Request $request)
    {
        $empresa = Empresa::create($request->all());
        $logs = new Actividad();
        $logs->log($request->user,'crear la empresa: '.$request->nombre);

        $user = User::create([  'name' => $request->nombre,
                            'email' => $request->nombre.'@gmail.com',
                            'username' => $request->nombre,
                            'password' => Hash::make('empresa')]);
        $user->assignRole('empresa');
        $empresa->user_id = $user->id;
        $empresa->save();

        return back()->with('exito','La Empresa ha sido agregado exitosamente');
    }

    public function edit_view(Request $request, $id)
    {
        if($request->ajax()){
            $empresas = Empresa::find($id);
            return response()->json($empresas);
        }
    }

    public function show($id)
    {
        $empresa = Empresa::find($id);       
        return view('empresa.modals.showEmpresa', ['empresaShow' => $empresa]);
    }

    public function edit(Request $request)
    {
        $id = $request->edit_id;
        $empresas = Empresa::find($id);

        if (empty($id)) {
            return back();
        }
        $empresas->nombre = $request->nombre;
        $empresas->nit = $request->nit;
        $empresas->nrc = $request->nrc;
        $empresas->sector_id = $request->sector_id;

        $empresas->save();
        $logs = new Actividad();
        $logs->log($request->user,'edito la empresa '.$request->nombre);
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
