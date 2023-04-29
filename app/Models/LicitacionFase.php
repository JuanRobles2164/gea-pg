<?php

namespace App\Models;

use App\Repositories\DocumentoLicitacion\DocumentoLicitacionRepository;
use App\Repositories\Fase\FaseRepository;
use App\Repositories\Licitacion\LicitacionRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicitacionFase extends Model
{
    use HasFactory;
    protected $table = 'licitacion_fase';
    protected $fillable = ["id", "fase", "licitacion", "observacion", "estado"];
    private $repo;

    public function documentoLicitacion(){
        $this->repo = DocumentoLicitacionRepository::GetInstance();
        $response = $this->repo->findByParams([
            'licitacion_fase' => $this->id
        ]);
        $this->repo = null;
        return $response;
    }

    public function licitacion(){
        $this->repo = LicitacionRepository::GetInstance();
        $response = $this->repo->find($this->licitacion);
        $this->repo = null;
        return $response;
    }

    public function fase(){
        $this->repo = FaseRepository::GetInstance();
        $response = $this->repo->find($this->fase);
        $this->repo = null;
        return $response;
    }
}
