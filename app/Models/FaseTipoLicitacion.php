<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaseTipoLicitacion extends Model
{
    use HasFactory;
    protected $table = 'fase_tipo_licitacion';
    protected $fillable = ["id", "orden", "fase", "tipo_licitacion","estado"];
}
