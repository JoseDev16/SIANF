<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use App\Models\orden_produccion;

class Material extends Model
{
    use HasFactory;

    public function productos(){
        return $this->belongsToMany(Producto::class, 'material_producto',  'material_id', 'producto_id')->withPivot('activo', 'cantidad');;
    }

    public function ordenes (){
        return $this->belongsToMany(Material::class, 'orden_materias', 'material_id', 'orden_id');
    }
}
// dd($request);
