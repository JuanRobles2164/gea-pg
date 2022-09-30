<?php

namespace App\View\Components;

use App\Repositories\Rol\RolRepository;
use Illuminate\View\Component;

class GuardarRol extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $modal_id, $modal_title, $model;
    
    private $repo = null;
    public function __construct($modalTitle = 'Formulario de Roles', $modalId, $modelId = -1)
    {
        $this->modal_id = $modalId;
        $this->modal_title = $modalTitle;
        if($modelId != -1){
            $this->repo = RolRepository::GetInstance();
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
        return view('components.guardar-rol');
    }
}
