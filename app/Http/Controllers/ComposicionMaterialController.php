<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComposicionMaterial;
use App\Models\Actividad;

class ComposicionMaterialController extends Controller
{
    public function index()
    {
        $composiciones = ComposicionMaterial::orderBy('id','desc')->paginate(5);
        return \view('composicion.index',compact('composiciones'));
    }

    public function store(Request $request)
    {

        ComposicionMaterial::create($request->all());
        $logs = new Actividad();
        $logs->log($request->user,'crear la composicion '.$request->nombre_composicion);

        return back()->with('exito','La composicion ha sido agregada exitosamente');
    }

    public function edit_view(Request $request, $id)
    {
        if($request->ajax()){
            $composicion = ComposicionMaterial::find($id);
            return response()->json($composicion);
        }
    }

    public function edit(Request $request)
    {

        $id = $request->edit_id;
        $composicion = ComposicionMaterial::find($id);

        if (empty($id)) {
            return back();
        }

        $composicion->nombre_composicion = $request->nomb_composicion;
        $composicion->save();
        $logs = new Actividad();
        $logs->log($request->user,'edito la composicion '.$request->nombre_composicion);

        return back()->with('exito','La composicion ha sido actualizada exitosamente');
    }

    public function destroy(Request $request)
    {
        $composicion = ComposicionMaterial::find($request->delete_id);
        $logs = new Actividad();
        $logs->log($request->user,'elimino la composicion '.$composicion->nombre_composicion);

        $composicion->delete();

        return back()->with('exito','La composicion ha sido eliminada exitosamente');
    }


}
