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
            ["Razón de Circulante", 1.5, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Prueba Acida", 1.5, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Razón de Capital de Trabajo", 0.25, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Razón de Efectivo", 0.20, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Razón de Rotación de Inventario", 8, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Razón de días de Inventarios", 45, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Razón de Rotación de cuentas por cobrar", 9, 2, "Se nececita mejorar", "Los valores coinciden", "Comportamiento aceptable"],
            ["Razón de periodo medio de cobranza", 40, 2, "Se nececita mejorar", "Los valores coinciden", "Comportamiento aceptable"],
            ["Razón de Rotación de cuentas por pagar", 6, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Periodo medio de pago", 60, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Índice de Rotación de Activos totales", 2, 2, "Se nececita mejorar", "Los valores coinciden", "Comportamiento aceptable"],
            ["Índice de Rotación de Activos Fijos", 2, 2, "Se nececita mejorar", "Los valores coinciden", "Comportamiento aceptable"],
            ["Índice de Margen Bruto",0.5, 1, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Índice de Margen Operativo",0.1, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Grado de Endeudamiento",0.4 ,1, 2, 2, "Se nececita mejorar", "Los valores coinciden", "Comportamiento aceptable"],
            ["Grado de Propiedad",0.6, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Razón de Endeudamiento Patrimonial", 1.5, 2, "Se nececita mejorar", "Los valores coinciden", "Comportamiento aceptable"],
            ["Razón de Cobertura de Gastos Financieros", 2, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Rentabilidad Neta del Patrimonio", 0.20, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Rentabilidad por Acción", 100, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Rentabilidad del Activo", 0.08, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Rentabilidad sobre ventas", 0.02, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
            ["Rentabilidad sobre inversión", 0.5, 1, "Comportamiento aceptable", "Los valores coinciden", "Se nececita mejorar"],
        ];

        foreach($razones as $razon){
            Parametros::create(['parametro' => $razon[0], 
                                'valor' => $razon[1], 
                                'tipo_id' => $razon[2],
                                'mayor' => $razon[3], 
                                'entre' => $razon[4],
                                'menor' => $razon[5]]);
        }  
    }
}
