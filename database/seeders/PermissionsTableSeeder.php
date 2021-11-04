<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permisos para usuario
        Permission::create(['name' => 'user.index']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.show']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.destroy']);
        Permission::create(['name' => 'user.updatePassword']);
        Permission::create(['name' => 'user.updatePasswordPost']);
        Permission::create(['name' => 'user.getRoles']);
        Permission::create(['name' => 'user.setRoles']);
        Permission::create(['name' => 'user.deleteRoles']);
        Permission::create(['name' => 'user.update']);


        //Permisos para rol
        Permission::create(['name' => 'rol.index']);
        Permission::create(['name' => 'rol.store']);
        Permission::create(['name' => 'rol.update']);
        Permission::create(['name' => 'rol.delete']);
        Permission::create(['name' => 'rol.edit']);

        //Permisos Logs
        Permission::create(['name' => 'logs.index']);
       //Permisos para CategoriaProducto
        Permission::create(['name' => 'categoria.index']);
        Permission::create(['name' => 'categoria.store']);
        Permission::create(['name' => 'categoria.edit_view']);
        Permission::create(['name' => 'categoria.edit']);
        Permission::create(['name' => 'categoria.destroy']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
        $user = User::create([  'name' => 'Administrador',
                            'email' => 'admin@gmail.com',
                            'username' => 'admin',
                            'password' => Hash::make('piperp3456')]);

        $user->assignRole('super-admin');






    }
}
