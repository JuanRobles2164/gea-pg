<?php

namespace App\View\Components;

use App\Repositories\Fase\FaseRepository;
use App\Repositories\TipoLicitacion\TipoLicitacionRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class GuardarTipoLicitacion extends Component
{
    public $modal_title, $modal_id;
    public $model;
    public $fases;
    public $fasesAgregadas;
    private $repo = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalTitle = 'Formulario para tipo de licitación', $modalId, $modelId = -1)
    {
        $this->modal_id = $modalId;
        $this->modal_title = $modalTitle;
        if($modelId != -1){
            $this->repo = TipoLicitacionRepository::GetInstance();
            $this->model = $this->repo->find($modelId);

            $this->repo = FaseRepository::GetInstance();
            $this->fasesAgregadas = $this->repo->findByParams($modelId);
            $this->repo = null;
        }
        $this->repo = FaseRepository::GetInstance();
        $this->fases = $this->repo->getAll();
        $this->repo = null;

        $fasesEliminar = [];
        if( $this->fases != null && $this->fasesAgregadas!= null){
            Log::debug((array) $this->fasesAgregadas);
            foreach($this->fases as $f){
                foreach($this->fasesAgregadas as $fa){
                    if($fa->id == $f->id){
                        array_push($fasesEliminar, $f->id);
                        break;
                    }
                }
            }
            $array_num = count($fasesEliminar);
            for ($i = 0; $i < $array_num; ++$i){
                unset($this->fases[$fasesEliminar[$i]]);
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.guardar-tipo-licitacion');
    }
}
