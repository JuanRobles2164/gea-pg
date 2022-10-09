<?php

namespace App\View\Components;

use App\Repositories\Rol\RolRepository;
use App\Repositories\User\UserRepository;
use Illuminate\View\Component;

class VerUsuario extends Component
{

    public $modal_title, $modal_id;
    public $model_id;
    public $model;
    public $roles;
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
            $this->repo = UserRepository::GetInstance();
            $this->model = $this->repo->find($modelId);
            $this->repo = null;
        }
        $this->repo = RolRepository::GetInstance();
        $this->roles = $this->repo->getAll();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ver-usuario');
    }
}
