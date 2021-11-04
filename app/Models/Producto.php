<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Material;
use App\Models\orden_reparacion;

class Producto extends Model
{
    use HasFactory;

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function materiales(){
        return $this->belongsToMany(Material::class, 'material_producto',  'producto_id', 'material_id');
    }

    public function ordenes(){
        return $this->belongsToMany(orden_reparacion::class, 'orden_productos', 'producto_id', 'orden_id');
    }
}
