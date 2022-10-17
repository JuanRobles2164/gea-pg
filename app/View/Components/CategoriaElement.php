<?php

namespace App\View\Components;

use App\Repositories\Categoria\CategoriaRepository;
use Illuminate\View\Component;

class CategoriaElement extends Component
{
    public $component_title;
    public $component_id;
    public $modelo;
    private $repo = null;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($componentId, $componentTitle = '', $modelId = -1, $modelo = null)
    {
        $this->component_title = $componentTitle;
        $this->component_id = $componentId;
        if($modelo != null){
            $this->modelo = $modelo;
        }
        if($modelId != -1 && $modelo == null){
            $this->repo = CategoriaRepository::GetInstance();
            $this->modelo = $this->repo->find($modelId);
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
        return view('components.categoria-element');
    }
}
