<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'rol';
    protected $fillable = ["id", "nombre", "descripcion","estado"];

    public const IS_ADMIN = 1;
    public const IS_GERENTE = 2;
    public const IS_OPERARIO = 3;

}
