<?php

namespace App\Models;

use App\Repositories\FaseTipoDocumento\FaseTipoDocumentoRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    use HasFactory;
    private $repo;
    protected $table = 'fase';
    protected $fillable = ["id", "nombre", "descripcion", "estado"];

    public function faseTipoDocumento(){
        $this->repo = FaseTipoDocumentoRepository::GetInstance();
        $response = $this->repo->findByFaseId($this->id);
        $this->repo = null;
        return $response;
    }
}
