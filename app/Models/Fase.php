<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    use HasFactory;
    protected $table = 'fase';
    protected $fillable = ["id", "nombre", "descripcion", "estado"];

    public function scopeDescripcion($query, $descripcion)
    {
        return $query->orWhere('descripcion','LIKE', "%$descripcion%");
    }

    public function scopeNombre($query, $nombre)
    {
        return $query->orWhere('nombre','LIKE', "%$nombre%");
    }
}
