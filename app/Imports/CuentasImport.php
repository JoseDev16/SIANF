<?php

namespace App\Imports;

use App\Models\Cuentas;
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
        return new Cuentas([
            //
            'codigo' => $row[1],
            'total' => $row[2],
        ]);
    }
}
