<?php

namespace App\View\Components;

use App\Repositories\Documento\DocumentoRepository;
use Illuminate\View\Component;


class VerDocumentoPrincipal extends Component
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
    public function __construct($modalTitle = 'Visualizador de Usuarios', $modalId, $modelId = -1)
    {
        $this->modal_id = $modalId;
        $this->modal_title = $modalTitle;
        if($modelId != -1){
            $this->repo = DocumentoRepository::GetInstance();
            $this->model = $this->repo->find($modelId);
            $this->model->numero = str_pad($this->model->numero,6,"0",STR_PAD_LEFT); 
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
        return view('components.ver-documento-principal');
    }
}
