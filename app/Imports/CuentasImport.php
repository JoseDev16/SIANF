<?php

namespace App\Imports;

use App\Models\Cuenta;
use Maatwebsite\Excel\Concerns\ToModel;

class CuentasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cuenta([
            //
            'codigo' => $row[1],
            'nombre' => $row[2],
            'tipo_id' => $row[3],
        ]);
    }
}
