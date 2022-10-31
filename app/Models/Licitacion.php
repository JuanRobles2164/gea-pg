<?php

namespace App\Models;

use App\Repositories\Categoria\CategoriaRepository;
use App\Repositories\Cliente\ClienteRepository;
use App\Repositories\TipoLicitacion\TipoLicitacionRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\Double;

class Licitacion extends Model
{
    use HasFactory;
    protected $table = 'licitacion';
    protected $fillable = ["id", "numero", "nombre", "descripcion", "fecha_inicio", "fecha_fin", "observacion", "estado", "cliente", "tipo_licitacion", "categoria"];

    public function categoria(){
        $this->repo = CategoriaRepository::GetInstance();
        return $this->repo->find($this->categoria);
    }

    public function cliente(){
        $this->repo = ClienteRepository::GetInstance();
        return $this->repo->find($this->categoria);
    }

    public function tipo_licitacion(){
        $this->repo = TipoLicitacionRepository::GetInstance();
        return $this->repo->find($this->categoria);
    }
}
