<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');        

        // $sectores = [
        //     [1,'Agropecuario'],
        //     [1,'Mineria'],
        //     [1,'Distribucion'],
        //     [1,'Ciencias de la informacion']
        // ];

        // foreach ($sectores as $sector){
        //     Sector::create(['id' => $sector[0], 'nombre' => $sector[1]]);
        // }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}