<?php

namespace App\View\Components;

use App\Repositories\TipoDocumento\TipoDocumentoRepository;
use Illuminate\View\Component;

class VerTipoDocumento extends Component
{
    public $modal_title, $modal_id;
    public $model_id;
    public $model;
    private $repo = null;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalTitle = 'Visualizador de Tipos de documento', $modalId, $modelId = -1)
    {
        $this->modal_id = $modalId;
        $this->modal_title = $modalTitle;
        if($modelId != -1){
            $this->repo = TipoDocumentoRepository::GetInstance();
            $this->model = $this->repo->find($modelId);
            $this->repo = null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ver-tipo-documento');
    }
}
