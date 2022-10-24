<?php

namespace App\Models;

use App\Repositories\Documento\DocumentoRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoLicitacion extends Model
{
    use HasFactory;
    protected $table = 'documento_licitacion';
    protected $fillable = ["id", "documento", "licitacion_fase", "revisado"];
    private $repo;

    public function documento(){
        $this->repo = DocumentoRepository::GetInstance();
        $response = $this->repo->find($this->documento);
        $this->repo = null;
        return $response;
    }
}
