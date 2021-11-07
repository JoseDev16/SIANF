<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
//use Illuminate\Support\Facades\DB;
use App\Models\TipoParametros;

class TipoParametrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Razones financieras
        $razones = [
            ["El incremento es positivo"],
            ["El incremento es negativo"],
        ];

        foreach($razones as $razon){
            TipoParametros::create(['nombre' => $razon[0]]);
        }  
    }
}
