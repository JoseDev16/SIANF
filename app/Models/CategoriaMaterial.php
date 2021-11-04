<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\SubCategoriaMaterial;

class CategoriaMaterial extends Model
{
    use HasFactory;
    protected $fillable=['nombre_categoriaMaterial'];

 

    public function subcategoriaMaterial()
    {
        return $this->hasMany(SubCategoriaMaterial::class);
    }
}
