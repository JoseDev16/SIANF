<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Periodo;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Periodos
        $periodos = [
            [5, 2019, 0, 0, 1],
            [6, 2020, 0, 0, 1],
            [8, 2019, 0, 0, 2],
            [7, 2020, 0, 0, 2],
            [4, 2019, 0, 0, 3],
            [5, 2020, 0, 0, 3],
            [3, 2019, 0, 0, 4],
            [4, 2020, 0, 0, 4],
        ];

        foreach($periodos as $periodo){
            Periodo::create(['acciones' => $periodo[0],
                            'year' => $periodo[1],
                            'gastos_financieros' => $periodo[2],
                            'inversion_inicial' => $periodo[3],
                            'empresa_id' => $periodo[4]]);
        }  

    }
}
