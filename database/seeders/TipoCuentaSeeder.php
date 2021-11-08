<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
//use Illuminate\Support\Facades\DB;
use App\Models\TipoCuenta;

class TipoCuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Razones financieras
        $tipos = [
            ["Balance general"],
            ["Estado de resultados"],
        ];

        foreach($tipos as $tipo){
            TipoCuenta::create(['nombre' => $tipo[0]]);
        }  
    }
}
