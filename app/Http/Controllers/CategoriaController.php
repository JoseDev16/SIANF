<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Actividad;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('id','desc')->paginate(5);
        return \view('categoria.index',compact('categorias'));
    }

    public function store(Request $request)
    {

        Categoria::create($request->all());
      //  dd($request);
        $logs = new Actividad();
        $logs->log($request->user,'crear la categoria '.$request->nombre_categoria);

        return back()->with('exito','La categoria ha sido agregada exitosamente');
    }

    public function edit_view(Request $request, $id)
    {
        if($request->ajax()){
            $categoria = Categoria::find($id);
            return response()->json($categoria);
        }
    }

    public function edit(Request $request)
    {

        $id = $request->edit_id;
        $this->validate($request, [
            'nomb_categoria' => 'required|max:20'
        ]);

        $categoria = Categoria::find($id);

        if (empty($id)) {
            return back();
        }

        $categoria->nombre_categoria = $request->nomb_categoria;
        $categoria->save();
        $logs = new Actividad();
        $logs->log($request->user,'edito la categoria '.$request->nomb_categoria);

        return back()->with('exito','La categoria ha sido actualizada exitosamente');
    }

    public function destroy(Request $request)
    {
        $categoria = Categoria::find($request->delete_id);
        $logs = new Actividad();
        $logs->log($request->user,'elimino la categoria '.$categoria->nombre_categoria);

        $categoria->delete();

        return back()->with('exito','La categoria ha sido eliminada exitosamente');
    }




}
