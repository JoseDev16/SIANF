<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoriaMaterial;

class SubCategoriaMaterial extends Model
{
    use HasFactory;

    public function categoria(){
        return $this->belongsTo(CategoriaMaterial::class,'categoriaMaterial_id');
    }
}
