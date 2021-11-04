<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaMaterial;
use App\Models\Actividad;

class CategoriaMaterialController extends Controller
{
    public function index()
    {
        $categoriaMateriales = CategoriaMaterial::orderBy('id','desc')->paginate(5);
        return \view('categoriaMaterial.index',compact('categoriaMateriales'));
    }

    public function store(Request $request)
    {

        CategoriaMaterial::create($request->all());
      //  dd($request);
        $logs = new Actividad();
        $logs->log($request->user,'crear la Categoria de Material '.$request->nombre_CategoriaMaterial);

        return back()->with('exito','La Categoria de Material ha sido agregada exitosamente');
    }

    public function edit_view(Request $request, $id)
    {
        if($request->ajax()){
            $categoriaMateriales = CategoriaMaterial::find($id);
            return response()->json($categoriaMateriales);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->edit_id;
        $categoriaMateriales = CategoriaMaterial::find($id);

        if (empty($id)) {
            return back();
        }

        $categoriaMateriales->nombre_categoriaMaterial = $request->nomb_categoriaMaterial;
        $categoriaMateriales->save();
        $logs = new Actividad();
        $logs->log($request->user,'edito la Categoria de Material '.$request->nomb_categoriaMaterial);

        return back()->with('exito','La Categoria de Material ha sido actualizada exitosamente');
    }

    public function destroy(Request $request)
    {
        $categoriaMateriales = CategoriaMaterial::find($request->delete_id);
        $logs = new Actividad();
        $logs->log($request->user,'elimino la Categoria de Material '.$categoriaMateriales->nombre_categoriaMaterial);

        $categoriaMateriales->delete();

        return back()->with('exito','La Categoria de Material ha sido eliminada exitosamente');
    }




}
