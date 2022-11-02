<?php

namespace App\Models;

use App\Repositories\TipoDocumento\TipoDocumentoRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaseTipoDocumento extends Model
{
    use HasFactory;
    protected $table = 'fase_tipo_documento';
    protected $fillable = ["id", "tipo_documento", "fase", "estado"];

    public function tipoDocumento(){
        $repo = TipoDocumentoRepository::GetInstance();
        $response = $repo->find($this->tipo_documento);
        return $response;
    }
}
