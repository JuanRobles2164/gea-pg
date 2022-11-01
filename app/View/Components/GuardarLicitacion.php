<?php

namespace App\View\Components;

use App\Repositories\Categoria\CategoriaRepository;
use App\Repositories\Cliente\ClienteRepository;
use App\Repositories\Licitacion\LicitacionRepository;
use App\Repositories\TipoLicitacion\TipoLicitacionRepository;
use Illuminate\View\Component;

class GuardarLicitacion extends Component
{
    public $modal_title, $modal_id;
    public $model;
    private $repo = null;
    public $clientes, $categorias, $tipos_licitacion;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalTitle = 'Formulario de Licitaciones',  $modalId, $modelId = -1)
    {
        $this->modal_title = $modalTitle;
        $this->modal_id = $modalId;

        if($modelId != -1 || $modelId != '-1'){
            $this->repo = LicitacionRepository::GetInstance();
            $this->modelo = $this->repo->find($modelId);
            $this->repo = null;
        }else{
            $this->modelo = null;
        }
        $this->repo = ClienteRepository::GetInstance();
        $this->clientes = $this->repo->getAll();
        $this->repo = null;

        $this->repo = CategoriaRepository::GetInstance();
        $this->categorias = $this->repo->getAll();
        $this->repo = null;

        $this->repo = TipoLicitacionRepository::GetInstance();
        $this->tipos_licitacion = $this->repo->getAll();
        $this->repo = null;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.guardar-licitacion');
    }
}
