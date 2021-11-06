<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Actividad extends Model
{
    use HasFactory;
    public $timestamps = true;

    public static function log($usuario,$accion)
    {
        $logs = new  Actividad;
        $logs->actividad = 'El usuario ' .$usuario. ' realizo la accion ' .$accion;
        $logs->save();


    }
}
