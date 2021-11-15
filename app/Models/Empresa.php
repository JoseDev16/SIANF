<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sector;


class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';
    protected $fillable = [
        'nombre','nit','nrc','sector_id','user_id'
    ];

    public function sector(){
        return $this->belongsTo(Sector::class);
    }
}
