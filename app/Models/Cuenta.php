<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $table = 'cuentas';
    protected $fillable = [
        'nombre',
        'codigo',
        'tipo_id',
    ];
    
    //Relacion uno a uno con TipoCuenta
    public function tipo(){
        return $this->hasOne('App\Models\Tipo');
    }

    //Relacion uno a uno con Empresa
    public function empesa(){
        return $this->hasOne('App\Models\Empesa');
    }
}
