<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Actividad;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\PasswordValidationRules;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
class UserController extends Controller
{

    public function index()
    {

        $usuarios = User::orderByDesc('id')->paginate(15);
        return view('users.index',compact('usuarios'));

    }

    //asigna el rol enviado a un usuario
    public function setRoles(Request $request)
    {
        $idRol = $request->rol_id2;
        $idUser = $request->user_id;
        $user = User::find($idUser);
        $rol = DB::table('roles')
                        ->where('id',  $idRol)
                        ->pluck('name');

        $user->assignRole($rol);
        $logs = new Actividad();
        $logs->log($request->user,' Asigno el rol '.$rol. 'Al usuario '.$user->name);
        return back()->with('setRole', 'Rol asignado con exito');

    }

    //Recibe el id de usuario
    public function getRoles($id)
    {
        $user = User::find($id);
        $roles = Role::all('name')->toArray();
        $userRol = $user->roles()->pluck('name');

        return response()->json($user);

    }

//Elimina rol asignado a un usuario
    public function deleteRoles(Request $request) {
        $idRol = $request->delete_id;
        $idUser = $request->usr_id;
        $user = User::find($idUser);


       // dd($request);
        $user->removeRole($idRol);
        $logs = new Actividad();
        $logs->log($request->user,'eliminar rol del usuario '.$user->name);
        return back()->with('deleteRole', 'Se ha removido el rol con exito');

    }

    public function getPassword($id)
    {
       $userPass = User::findOrFail($id);
        return view('users.updatePassword', [ 'userPass' => $userPass]);
    }

    

    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'password' => 'required|min:8',

        ]);
        $user->password =  Hash::make($request->password);
        $user->save();
        $logs = new Actividad();
        $logs->log($request->user,'Cambio de clave en el usuario '.$user->name);

        return back()->with('updatePass', 'Contraseña actualizada');

    }

   public function asignarList (Request $request)
   {
        //databable
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $btn = '<button type="button" title="Editar" data-toggle="modal" data-target="#editModal" class="fas fa-w fa-edit h4"
                        style="color:gray !important; background-color:transparent; border: 0px solid;" onclick="fun_edit('.$data->id.')"></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $roles = DB::table('roles')->get();

        return view('users.asignar',compact("roles"));

    }



    public function show($id)
    {

        $usuario = User::findOrFail($id);


       return view('users.show', ['userShow' => $usuario,]);

    }

    public function edit(Request $request,$id)
    {
        $userActualizar = User::findOrFail($id);
        $roles = Role::all();

        $existe=true;

        if($userRol= $userActualizar->hasRole($roles))
        {
            $userRol = $userActualizar->roles()->pluck('name');
           // dd($userRol);

        }else $userRol=false;



       return view('users.edit', [ 'userActualizar' => $userActualizar,'userRol' => $userRol,'rolesQuery' => $roles]);
    }


    public function update(Request $request, $id)
    {
        $userUpdate = User::findOrFail($id);
        $userUpdate->name= $request->name;
        $userUpdate->username= $request->username;
        $userUpdate->email= $request->email;
        $userUpdate->save();
        $logs = new Actividad();
        $logs->log($request->user,' editar el usuario '.$userUpdate->name);

        return redirect('usuarios')->with('update', 'El usuario ha sido actualizado correctamente');

    }


    public function destroy(Request $request)
    {
        $user = User::find($request->delete_id);
        $user->delete();
        $logs = new Actividad();
        $logs->log($request->user,'Eliminar el usuario '.$user->name);
        return redirect('usuarios')->with('delete','El usuario ha sido eliminado exitosamente');

    }

}
