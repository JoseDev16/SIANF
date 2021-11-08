<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaPeriodo extends Model
{
    use HasFactory;

    protected $table = 'cuenta_periodos';
    protected $fillable = [
        'cuenta_id',
        'periodo_id',
        'total',
    ];
    
    //Relacion muchis a uno con Periodo
    public function periodo(){
        return $this->belongsTo('App\Models\Periodo');
    }

    //Relacion muchos a uno con Cuenta
    public function cuenta(){
        return $this->belongsTo('App\Models\Cuenta');
    }
}
