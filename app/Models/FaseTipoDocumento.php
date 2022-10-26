<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaseTipoDocumento extends Model
{
    use HasFactory;
    protected $table = 'fase_tipo_documento';
    protected $fillable = ["id", "tipo_documento", "fase", "estado"];
}
