<?php

namespace App\Models;

use App\Repositories\DocumentoLicitacion\DocumentoLicitacionRepository;
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
}
