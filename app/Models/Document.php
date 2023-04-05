<?php

namespace App\Models;

use App\Repositories\TipoDocumento\TipoDocumentoRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documento';
    protected $fillable = ["numero", "nombre", "nombre_archivo", "descripcion", "recurrente", 
                        "constante", "fecha_vencimiento", "path_file", "data_file", "estado", 
                        "tipo_documento", "padre"];

    public function tipo_documento(){
        $this->repo = TipoDocumentoRepository::GetInstance();
        return $this->repo->find($this->tipo_documento);
    }

    public function scopeNumero($query, $numero)
    {
        return $query->orWhere('numero','LIKE', "%$numero%");
    }

    public function scopeNombre($query, $nombre)
    {
        return $query->orWhere('nombre','LIKE', "%$nombre%");
    }

}
