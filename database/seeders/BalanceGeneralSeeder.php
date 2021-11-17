<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\BalanceGeneral;

class BalanceGeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $balances = [
            [1, 12580, 8367, 256, 2804, 5307, 4213, 4213, 7735, 4260, 4260, 3475, 4845, 4845],
            [2, 12962, 7664, 386, 3042, 4236, 5298, 5298, 6598, 4123, 4123, 2475, 6364, 6364],
            [3, 15368, 10342, 639, 3205, 6496, 5026, 5026, 9556, 5043, 5043, 4215, 5812, 5812],
            [4, 20489, 13954, 823, 5206, 7925, 6535, 6535, 12563, 7539, 7539, 5024, 7926, 7926],
            [5, 12596, 8436, 3698, 2614, 2124, 4160, 4160, 5367, 3256, 3256, 2111, 7229, 7229],
            [6, 14638, 9227, 4215, 3478, 1534, 5411, 5411, 6521, 3963, 3963, 2558, 8117, 8117],
           
        ];

        foreach($balances as $balance){
            BalanceGeneral::create(['periodo_id' => $balance[0], 
                                'activos' => $balance[1], 
                                'activo_corriente' => $balance[2],
                                'efectivo' => $balance[3], 
                                'cuentas_por_cobrar' => $balance[4],
                                'inventario' => $balance[5], 
                                'activo_no_corriente' => $balance[6], 
                                'activo_fijo_neto' => $balance[7],
                                'pasivos' => $balance[8], 
                                'pasivo_corriente' => $balance[9],
                                'cuentas_por_pagar' => $balance[10], 
                                'pasivo_no_corriente' => $balance[11], 
                                'patrimonio' => $balance[12],
                                'capital_social' => $balance[13]]);
        }  
    }
}
