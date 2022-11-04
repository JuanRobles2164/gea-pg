<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;
    protected $table = 'tipo_documento';
    protected $fillable = ["id", "nombre", "descripcion", "valor_actual", "indicativo","estado"];

    public function scopeDescripcion($query, $descripcion)
    {
        return $query->orWhere('descripcion','LIKE', "%$descripcion%");
    }

    public function scopeNombre($query, $nombre)
    {
        return $query->orWhere('nombre','LIKE', "%$nombre%");
    }

}
