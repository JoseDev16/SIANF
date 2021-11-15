<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Cuenta;

class CuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Razones financieras
        $empresas = [
            ["1", "Activo", 1, 1],
            ["1.1", "Activo corriente", 1, 1],
            ["1.1.2", "Efectivo", 1, 1],
            ["1.1.3", "Cuentas por cobrar comerciales", 1, 1],
            ["1.1.4", "Inventario", 1, 1],
            ["1.2", "Activo no corriente", 1, 1],
            ["1.2.1", "Activo fijo neto", 1, 1],
            ["2", "Pasivo", 1, 2],
            ["2.1", "Pasivo corriente", 1, 2],
            ["2.1.1", "Cuentas por pagar comerciales", 1, 2],
            ["2.2", "Pasivo no corriente", 1, 2],
            ["3", "Patrimonio", 1, 3],
            ["3.1", "Capital social", 1, 3],
            ["4", "Ventas netas", 1, 4],
            ["5", "Costo de ventas", 1, 5],
            ["6.1", "Utilidad bruta", 1, 6],
            ["5.1", "Gastos de ventas", 1, 5],
            ["5.2", "Gastos de administracion", 1, 5],
            ["6.2", "Utilidad de operación", 1, 6],
            ["5.3", "Gastos financieros", 1, 5],
            ["6.3", "Utilidades antes de impuestos e intereses", 1, 6],
            ["5.4", "Intereses", 1, 5],
            ["5.5", "Impuestos", 1, 5],
            ["6.4", "Utilidad neta", 1, 6],

            ["1", "Activo", 2, 1],
            ["1.1", "Activo corriente", 2, 1],
            ["1.1.2", "Efectivo", 2, 1],
            ["1.1.3", "Cuentas por cobrar comerciales", 2, 1],
            ["1.1.4", "Inventario", 2, 1],
            ["1.2", "Activo no corriente", 2, 1],
            ["1.2.1", "Activo fijo neto", 2, 1],
            ["2", "Pasivo", 2, 2],
            ["2.1", "Pasivo corriente", 2, 2],
            ["2.1.1", "Cuentas por pagar comerciales", 2, 2],
            ["2.2", "Pasivo no corriente", 2, 2],
            ["3", "Patrimonio", 2, 3],
            ["3.1", "Capital social", 2, 3],
            ["4", "Ventas netas", 2, 4],
            ["5", "Costo de ventas", 2, 5],
            ["6.1", "Utilidad bruta", 2, 6],
            ["5.1", "Gastos de ventas", 2, 5],
            ["5.2", "Gastos de administracion", 2, 5],
            ["6.2", "Utilidad de operación", 2, 6],
            ["5.3", "Gastos financieros", 2, 5],
            ["6.3", "Utilidades antes de impuestos e intereses", 2, 6],
            ["5.4", "Intereses", 2, 5],
            ["5.5", "Impuestos", 2, 5],
            ["6.4", "Utilidad neta", 2, 6],

            ["1", "Activo", 3, 1],
            ["1.1", "Activo corriente", 3, 1],
            ["1.1.2", "Efectivo", 3, 1],
            ["1.1.3", "Cuentas por cobrar comerciales", 3, 1],
            ["1.1.4", "Inventario", 3, 1],
            ["1.2", "Activo no corriente", 3, 1],
            ["1.2.1", "Activo fijo neto", 3, 1],
            ["2", "Pasivo", 3, 2],
            ["2.1", "Pasivo corriente", 3, 2],
            ["2.1.1", "Cuentas por pagar comerciales", 3, 2],
            ["2.2", "Pasivo no corriente", 3, 2],
            ["3", "Patrimonio", 3, 3],
            ["3.1", "Capital social", 3, 3],
            ["4", "Ventas netas", 3, 4],
            ["5", "Costo de ventas", 3, 5],
            ["6.1", "Utilidad bruta", 3, 6],
            ["5.1", "Gastos de ventas", 3, 5],
            ["5.2", "Gastos de administracion", 3, 5],
            ["6.2", "Utilidad de operación", 3, 6],
            ["5.3", "Gastos financieros", 3, 5],
            ["6.3", "Utilidades antes de impuestos e intereses", 3, 6],
            ["5.4", "Intereses", 3, 5],
            ["5.5", "Impuestos", 3, 5],
            ["6.4", "Utilidad neta", 3, 6],

            ["1", "Activo", 4, 1],
            ["1.1", "Activo corriente", 4, 1],
            ["1.1.2", "Efectivo", 4, 1],
            ["1.1.3", "Cuentas por cobrar comerciales", 4, 1],
            ["1.1.4", "Inventario", 4, 1],
            ["1.2", "Activo no corriente", 4, 1],
            ["1.2.1", "Activo fijo neto", 4, 1],
            ["2", "Pasivo", 4, 2],
            ["2.1", "Pasivo corriente", 4, 2],
            ["2.1.1", "Cuentas por pagar comerciales", 4, 2],
            ["2.2", "Pasivo no corriente", 4, 2],
            ["3", "Patrimonio", 4, 3],
            ["3.1", "Capital social", 4, 3],
            ["4", "Ventas netas", 4, 4],
            ["5", "Costo de ventas", 4, 5],
            ["6.1", "Utilidad bruta", 4, 6],
            ["5.1", "Gastos de ventas", 4, 5],
            ["5.2", "Gastos de administracion", 4, 5],
            ["6.2", "Utilidad de operación", 4, 6],
            ["5.3", "Gastos financieros", 4, 5],
            ["6.3", "Utilidades antes de impuestos e intereses", 4, 6],
            ["5.4", "Intereses", 4, 5],
            ["5.5", "Impuestos", 4, 5],
            ["6.4", "Utilidad neta", 4, 6],
        ];

        foreach($empresas as $empresa){
            Cuenta::create(['codigo' => $empresa[0], 
                                'nombre' => $empresa[1], 
                                'empresa_id' => $empresa[2],
                                'tipo_id' => $empresa[3]]);
        }  
    }
}
