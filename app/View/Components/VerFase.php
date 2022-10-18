<?php

namespace App\View\Components;

use App\Repositories\Fase\FaseRepository;
use App\Repositories\TipoDocumento\TipoDocumentoRepository;
use Illuminate\View\Component;

class VerFase extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $modal_title, $modal_id;
    public $model;
    public $tipos_documento;
    private $repo = null;
    public function __construct($modalTitle = 'Visualizador de Fase', $modalId, $modelId = -1)
    {
        $this->modal_id = $modalId;
        $this->modal_title = $modalTitle;
        if($modelId != -1){
            $this->repo = FaseRepository::GetInstance();
            $this->model = $this->repo->find($modelId);
            $this->repo = null;
        }

        $this->repo = TipoDocumentoRepository::GetInstance();
        $this->tipos_documento = $this->repo->getAll();
        $this->repo = null;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ver-fase');
    }
}
