<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromedioRatios extends Model
{
    use HasFactory;

    protected $table = 'promedio_ratios';
    protected $fillable = [
        'parametro_id','sector_id','valor_promedio'
    ];
}
