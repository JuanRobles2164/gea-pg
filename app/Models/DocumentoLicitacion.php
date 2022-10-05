<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoLicitacion extends Model
{
    use HasFactory;
    protected $table = 'documento_licitacion';
    protected $fillable = ["id", "documento", "licitacion_fase"];
}
