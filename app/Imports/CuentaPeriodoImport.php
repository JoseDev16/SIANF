<?php

namespace App\Imports;

use App\Models\CuentaPeriodo;
use Maatwebsite\Excel\Concerns\ToModel;

class CuentaPeriodoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CuentaPeriodo([
            'cuenta_id' => $row[0],
            'total' => $row[3],
        ]);
    }
}
