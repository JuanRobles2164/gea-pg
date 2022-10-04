<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licitacion extends Model
{
    use HasFactory;
    protected $table = 'licitacion';
    protected $fillable = ["id", "nombre", "fecha_inicio", "fecha_fin", "clonado", "cliente", "estado"];
}
