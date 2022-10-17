<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicitacionFase extends Model
{
    use HasFactory;
    protected $table = 'licitacion_fase';
    protected $fillable = ["id", "fase", "licitacion", "observacion", "estado"];
}
