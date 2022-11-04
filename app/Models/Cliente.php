<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    protected $fillable = ["id", "razon_social", "email", "direccion", "identificacion", "tipo_identificacion", "telefono", "estado"];

    public function scopeRazon($query, $razon_social)
    {
        return $query->orWhere('razon_social','LIKE', "%$razon_social%");
    }

    public function scopeEmail($query, $email)
    {
        return $query->orWhere('email','LIKE', "%$email%");
    }

    public function scopeIdentificacion($query, $identificacion)
    {
        return $query->orWhere('identificacion','LIKE', "%$identificacion%");
    }
}
