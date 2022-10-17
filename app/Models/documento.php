<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
    protected $table = 'documento';
    protected $fillable = ["numero", "nombre", "descripcion", "recurrente", "constante", "fecha_vencimiento", "path_file", "data_file", "estado", "tipo_documento"];
}
