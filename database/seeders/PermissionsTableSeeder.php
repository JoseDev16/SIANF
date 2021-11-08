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
        $admin = Role::create(['name' => 'super-admin']);
        $empresa = Role::create(['name' => 'empresa']);

        //Permisos para usuario
        Permission::create(['name' => 'user.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.destroy'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.updatePassword'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.updatePasswordPost'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.getRoles'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.setRoles'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.deleteRoles'])->syncRoles([$admin]);
        Permission::create(['name' => 'user.update'])->syncRoles([$admin]);


        //Permisos para rol
        Permission::create(['name' => 'rol.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'rol.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'rol.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'rol.delete'])->syncRoles([$admin]);
        Permission::create(['name' => 'rol.edit'])->syncRoles([$admin]);

        //Permisos Logs
        Permission::create(['name' => 'logs.index'])->syncRoles([$admin]);
       //Permisos para CategoriaProducto
        /*Permission::create(['name' => 'categoria.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'categoria.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'categoria.edit_view'])->syncRoles([$admin]);
        Permission::create(['name' => 'categoria.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'categoria.destroy'])->syncRoles([$admin]);*/

        //Permisos para cuenta
        Permission::create(['name' => 'cuenta.index'])->syncRoles([$empresa]);
        Permission::create(['name' => 'cuenta.store'])->syncRoles([$empresa]);
        Permission::create(['name' => 'cuenta.update'])->syncRoles([$empresa]);
        Permission::create(['name' => 'cuenta.delete'])->syncRoles([$empresa]);
        Permission::create(['name' => 'cuenta.edit'])->syncRoles([$empresa]);

        //Permisos para tipo cuenta
        Permission::create(['name' => 'tipocuenta.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'tipocuenta.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'tipocuenta.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'tipocuenta.delete'])->syncRoles([$admin]);
        Permission::create(['name' => 'tipocuenta.edit'])->syncRoles([$admin]);

        //Permisos para parametros
        Permission::create(['name' => 'parametros.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'parametros.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'parametros.edit'])->syncRoles([$admin]);

        //Permisos para cuenta periodo
        Permission::create(['name' => 'cuentaperiodo.index'])->syncRoles([$empresa]);
        Permission::create(['name' => 'cuentaperiodo.store'])->syncRoles([$empresa]);
        Permission::create(['name' => 'cuentaperiodo.update'])->syncRoles([$empresa]);
        Permission::create(['name' => 'cuentaperiodo.delete'])->syncRoles([$empresa]);
        Permission::create(['name' => 'cuentaperiodo.edit'])->syncRoles([$empresa]);

        //Permisos para periodo
        Permission::create(['name' => 'periodo.index'])->syncRoles([$empresa]);
        Permission::create(['name' => 'periodo.store'])->syncRoles([$empresa]);
        Permission::create(['name' => 'periodo.update'])->syncRoles([$empresa]);
        Permission::create(['name' => 'periodo.delete'])->syncRoles([$empresa]);
        Permission::create(['name' => 'periodo.edit'])->syncRoles([$empresa]);

        //Permisos para empresa
        Permission::create(['name' => 'empresa.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'empresa.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'empresa.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'empresa.delete'])->syncRoles([$admin]);
        Permission::create(['name' => 'empresa.edit'])->syncRoles([$admin]);

        //Permisos para sectores
        Permission::create(['name' => 'sectores.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'sectores.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'sectores.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'sectores.delete'])->syncRoles([$admin]);
        Permission::create(['name' => 'sectores.edit'])->syncRoles([$admin]);


        
        //$role->givePermissionTo(Permission::all());
        
        $user = User::create([  'name' => 'Administrador',
                            'email' => 'admin@gmail.com',
                            'username' => 'admin',
                            'password' => Hash::make('piperp3456')]);
        $user->assignRole('super-admin');

    }
}
