<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Actividad;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* $editandshow = DB::table('permissions')
        ->where('slug', 'like','%'.'edit_view'.'%')
        ->orWhere('slug', 'like','%'.'showDataModal'.'%')
        ->pluck('slug');*/

        $roles = DB::table('roles')->get();
        $permissions = DB::table('permissions')->get();
       // dd($permissions);
       // ->whereNotIn('slug', $editandshow )->get();


      //  $roles = Role::all();

        return view('roles.create',compact(['roles','permissions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idpermisos = $request->permissions;
        $role=Role::create($request->all());
        $role->permissions()->sync($idpermisos);
        $logs = new Actividad();
        $logs->log($request->user,'crear el rol '.$role->name);

        return back()->with('exito','Listo! Rol agregado con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {

        $rolid = Role::find($id);
        //dd($rol);
        $rol=$rolid->permissions()->pluck('permission_id');
        //dd($rol);
        $permisosRol = DB::table('permissions')

                    ->whereIn('id', $rol)
                    ->get();
        $permisosNoAsignados=DB::table('permissions')

                        ->whereNotIn('id', $rol)
                         ->get();


        //dd($permisosNoAsignados);



        return view('roles.edit',['permisos' => $permisosRol, 'permisosNoAsignados' => $permisosNoAsignados,'rol' => $rolid]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $idpermisos= $request->permisos;
        $role=Role::find($request->rol_id);
        $role->name= $request->name;
        $role->save();

        $role->permissions()->sync($idpermisos);
        $logs = new Actividad();
        $logs->log($request->user,'editar rol');
        return back()->with('exito','Rol modificado con exito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       // dd($request);
        $rol = Role::find($request->delete_id);
        $logs = new Actividad();
        $logs->log($request->user,'eliminar rol '.$rol->name);
        $rol->delete();
        return back()->with('delete','El usuario ha sido eliminado exitosamente');

    }
}
