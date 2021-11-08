<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
//use Illuminate\Support\Facades\DB;
use App\Models\Parametros;

class ParametrosSeeder extends Seeder
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
            ["Razón de Circulante",1],
            ["Prueba Acida",1],
            ["Razón de Capital de Trabajo",1],
            ["Razón de Efectivo",1],
            ["Razón de Rotación de Inventario",1],
            ["Razón de días de Inventarios",1],
            ["Razón de Rotación de cuentas por cobrar",1],
            ["Razón de periodo medio de cobranza",1],
            ["Razón de Rotación de cuentas por pagar",1],
            ["Periodo medio de pago",1],
            ["Índice de Rotación de Activos totales",1],
            ["Índice de Rotación de Activos Fijos",1],
            ["Índice de Margen Bruto",1],
            ["Índice de Margen Operativo",1],
            ["Grado de Endeudamiento",1],
            ["Grado de Propiedad",1],
            ["Razón de Endeudamiento Patrimonial",1],
            ["Razón de Cobertura de Gastos Financieros",1],
            ["Rentabilidad Neta del Patrimonio",1],
            ["Rentabilidad por Acción",1],
            ["Rentabilidad Neta del Patrimonio",1],
            ["Rentabilidad del Activo",1],
            ["Rentabilidad sobre ventas",1],
            ["Rentabilidad sobre inversión",1],
        ];

        foreach($razones as $razon){
            Parametros::create(['parametro' => $razon[0], 'tipo_id' => $razon[1]]);
        }  
    }
}
