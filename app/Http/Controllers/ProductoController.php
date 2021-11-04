<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Actividad;
use App\Models\Material;

class ProductoController extends Controller
{
    //
    public function index()
    {
        $productos = Producto::orderBy('id','desc')->paginate(10);
        $categorias = Categoria::all();

        return \view('producto.index',compact('productos','categorias'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $producto = new Producto;
        $producto->nombre_producto = $request->nombre_producto;
        $producto->unidad_medida = $request->unidad_id;
        $producto->categoria_id = $request->categoria_id;

        $codigoPrueba = Producto::where('codigo_producto', $request->codigo_producto);
        if(!$codigoPrueba)
        {
            return back()->with('ocupado', 'Este codigo ya existe en el sistema');

        }else
        {
            $producto->codigo_producto = $request->codigo_producto;
            $producto->save();
            return back()->with('exito', 'Producto agregado con exito');


        }


    }

    public function edit_view(Request $request, $id)
    {
        if($request->ajax()){
            $producto = Producto::find($id);
            return response()->json($producto);
        }
    }

    public function edit(Request $request)
    {

        $id = $request->edit_id;
       $producto = Producto::find($id);

        if (empty($id)) {
            return back();
        }

        $producto->nombre_producto = $request->nomb_producto;
        $producto->categoria_id = $request->cat_id;
        $producto->save();
        $logs = new Actividad();
        $logs->log($request->user,'edito la categoria '.$request->nomb_categoria);

        return back()->with('exito','La categoria ha sido actualizada exitosamente');
    }

    public function addMaterial(Request $request)
    {
        //dd($request);
       if(!$request->edit)
     {
        if($request->activo)
        {
            DB::table('material_producto')->insert([
                'material_id' => $request->id_material,
                'producto_id' => $request->id_producto,
                'activo' => 1,
                'cantidad' => $request->cantidad_material

            ]);
            return back()->with('exito', 'Material agregado con exito');

        }else
        {
            DB::table('material_producto')->insert([
                'material_id' => $request->id_material,
                'producto_id' => $request->id_producto,
                'activo' => 0,
                'cantidad' => $request->cantidad_material

            ]);
            return back()->with('exito', 'Material agregado con exito');

        }

      }else
       {
        if($request->activo)
        {
            DB::table('material_producto')
            ->where('material_id',$request->id_material)
            ->where('producto_id',$request->id_producto)
            ->update(['activo' => 1, 'cantidad' =>$request->cantidad_material]);
            return back()->with('exito', 'Material agregado con exito');

        }else
        {
            DB::table('material_producto')
            ->where('material_id',$request->id_material)
            ->where('producto_id',$request->id_producto)
            ->update(['activo' => 0, 'cantidad' =>$request->cantidad_material]);
            return back()->with('exito', 'Material agregado con exito');

        }


       }



    }
//
    public function editRegistros($id)
    {
        $materiales = DB::table('material_producto')
        ->select('material_producto.*','materials.nombre_material','materials.unidad_medida','materials.codigo_material','materials.id as idMaterial')
        ->join('materials', 'materials.id', '=', 'material_producto.material_id')
        ->join('productos', 'productos.id', '=', 'material_producto.producto_id')
        ->where('material_producto.id','=',$id)->get();
        return response()->json($materiales);

    }


 //RECIBE ID DEL PRODUCTO
    public function setMaterial(Request $request,$id)
    {
        $prueba="00";
        $posts = Material::where('codigo_material', 'LIKE', '%'.$prueba.'%')->pluck('codigo_material');
        $p2=Material::where('codigo_material','RT001')->pluck('codigo_material');


        $producto= Producto::find($id);
       // $materiales=  $producto->materiales()->get();

        $materiales = DB::table('material_producto')
        ->select('material_producto.*','materials.nombre_material','materials.unidad_medida','materials.codigo_material','productos.nombre_producto')
        ->join('materials', 'materials.id', '=', 'material_producto.material_id')
        ->join('productos', 'productos.id', '=', 'material_producto.producto_id')
        ->where('material_producto.producto_id', $id)->get();

      // dd($materiales);

       //dd($materiales);

        return view('producto.addMaterial', compact('producto', 'materiales'));


    }
    //destroye producto asociado a un material
    public function destroyMaterial(Request $request)
    {

        DB::table('material_producto')
        ->where('id',$request->delete_id)
        ->delete();
        return back()->with('exito','La categoria ha sido eliminada exitosamente');
    }

    public function destroy(Request $request)
    {
      
        $material = Material::find($request->delete_id);
        //dd($categoria);
        $logs = new Actividad();
        $logs->log($request->user,'elimino el material '.$material->nombre_material);

        $material->delete();

        return back()->with('exito','La categoria ha sido eliminada exitosamente');
    }


}
