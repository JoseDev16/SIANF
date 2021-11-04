<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class orden_reparacion extends Model
{
    use HasFactory;
    
    public function productos (){
        return $this->belongsToMany(Producto::class, 'orden_productos', 'orden_id', 'producto_id');
    }

    public function materiales (){
        return $this->belongsToMany(Material::class, 'orden_materias', 'orden_id', 'material_id');
    }
}
