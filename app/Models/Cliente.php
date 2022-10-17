<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    protected $fillable = ["id", "razon_social", "email", "direccion", "identificacion", "tipo_identificacion", "telefono", "estado"];
}
