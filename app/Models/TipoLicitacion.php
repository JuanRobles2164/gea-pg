<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoLicitacion extends Model
{
    use HasFactory;
    protected $table = 'tipo_licitacion';
    protected $fillable = ["id", "nombre", "descripcion", "valor_actual", "indicativo", "estado"];

    public function scopeNombre($query, $nombre)
    {
        return $query->orWhere('nombre','LIKE', "%$nombre%");
    }

    public function scopeDescripcion($query, $descripcion)
    {
        return $query->orWhere('descripcion','LIKE', "%$descripcion%");
    }

    public function scopeIndicativo($query, $indicativo)
    {
        return $query->orWhere('indicativo','LIKE', "%$indicativo%");
    }
}
