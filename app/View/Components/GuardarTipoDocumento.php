<?php

namespace App\View\Components;

use App\Repositories\TipoDocumento\TipoDocumentoRepository;
use Illuminate\View\Component;

class GuardarTipoDocumento extends Component
{
    public $modal_title, $modal_id;
    public $model;
    private $repo = null;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalTitle = 'Formulario de tipos de Documento', $modalId, $modelId = -1)
    {
        $this->modal_id = $modalId;
        $this->modal_title = $modalTitle;
        if($modelId != -1){
            $this->repo = TipoDocumentoRepository::GetInstance();
            $this->model = $this->repo->find($modelId);
        }

        $this->repo = null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.guardar-tipo-documento');
    }
}
