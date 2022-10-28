<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoLicitacion extends Model
{
    use HasFactory;
    protected $table = 'tipo_licitacion';
    protected $fillable = ["id", "nombre", "descripcion", "valor_actual", "indicativo", "estado"];
}
