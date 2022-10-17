<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licitacion extends Model
{
    use HasFactory;
    protected $table = 'licitacion';
    protected $fillable = ["id", "numero", "nombre", "descripcion", "fecha_inicio", "fecha_fin", "observacion", "estado", "cliente", "tipo_licitacion", "categoria"];
}
