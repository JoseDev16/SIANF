<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use DB;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('fibertex'),

        ]);

    }
}
