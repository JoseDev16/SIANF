<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaMaterial;
use App\Models\Actividad;
use App\Models\SubCategoriaMaterial;


class SubCategoriaMaterialController extends Controller
{
    public function index(Request $request)
    {
        $subcategorias = SubCategoriaMaterial::orderBy('id','desc')->paginate(5);
        $categorias = CategoriaMaterial::all();
        return \view('subCategoriaMaterial.index',compact(['subcategorias', 'categorias']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_subcategoria' => 'required|max:20'
        ]);

        $subcategoria = new SubCategoriaMaterial;
        $subcategoria->categoriaMaterial_id= $request->categoria_id;
        $subcategoria->nombre_subcategoria_material = $request->nombre_subcategoria;
        $subcategoria->save();
        return back()->with('exito','La subcategoria ha sido agregada exitosamente');
    }

    public function edit_view(Request $request, $id)
    {

        if($request->ajax()){
            $subcategoria = SubCategoriaMaterial::find($id);

            return response()->json($subcategoria);
        }
    }

    public function edit(Request $request)
    {

        $id = $request -> edit_id;

        $this->validate($request, [
            'nomb_subcategoria' => 'required|max:20'
        ]);

        $subcategoria = SubCategoriaMaterial::find($id);

        if (empty($id)) {

            return back();
        }

        //$this->authorize('verify', $subcategoria);
        $subcategoria->categoriaMaterial_id = $request->cat_id;
        $subcategoria->nombre_subcategoria_material  = $request->nomb_subcategoria;
        $subcategoria->save();

        return back()->with('exito','La subcategoria ha sido actualizada exitosamente');
    }

    public function destroy(Request $request)
    {
        $id = $request->delete_id;
        $subcategoria = SubCategoriaMaterial::find($id);

        if (empty($subcategoria)) {
            return back();
        }

        //$this->authorize('verify', $subcategoria);
        $subcategoria->delete();
        return back()->with('exito','La subcategoria ha sido eliminada exitosamente');
    }

}
