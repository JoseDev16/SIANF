<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\EstadoResultado;

class EstadoResultadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $estados = [
            [1, 27047, 18031, 9016, 4569, 3057, 1390, 250, 1140, 0, 150, 990],
            [2, 31694, 20695, 10999, 4821, 3269, 2909, 250, 2659, 0, 150, 2509],
            [3, 30423, 20368, 10055, 5692, 2245, 2118, 200, 1918, 0, 200, 1718],
            [4, 37426, 25614, 11812, 6369, 2245, 3198, 200, 2998, 0, 200, 2798],
            [5, 18527, 9753, 8774, 2456, 1348, 4970, 500, 4470, 0, 350, 4120],
            [6, 20863, 11235, 9628, 2963, 1425, 5240, 500, 4740, 0, 350, 4390],
           
        ];

        foreach($estados as $estado){
            EstadoResultado::create(['periodo_id' => $estado[0], 
                                'ventas_netas' => $estado[1], 
                                'costo_ventas' => $estado[2],
                                'utilidad_bruta' => $estado[3], 
                                'gastos_ventas' => $estado[4],
                                'gastos_administracion' => $estado[5], 
                                'utilidad_operativa' => $estado[6], 
                                'gastos_financieros' => $estado[7],
                                'utilidad_antes_de_i' => $estado[8], 
                                'intereses' => $estado[9],
                                'impuestos' => $estado[10], 
                                'utilidad_neta' => $estado[11]]);
        } 
    }
}
