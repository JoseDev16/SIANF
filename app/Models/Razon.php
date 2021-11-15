<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Razon extends Model
{
    use HasFactory;

    protected $table = 'razons';
    protected $fillable = [
        'periodo_id','parametro_id','double'
    ];

    public static function getRatios($peridoId){
        return Razon::join('parametros', 'parametros.id', '=', 'razons.parametro_id')
        ->where('periodo_id', '=', $peridoId)
        ->get();

    }
}
