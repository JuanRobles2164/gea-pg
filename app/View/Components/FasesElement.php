<?php

namespace App\View\Components;

use App\Repositories\LicitacionFase\LicitacionFaseRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class FasesElement extends Component
{
    public $modelo, $licitacion, $documentos;
    private $repo;
    public $licitacion_fase;

    public $component_id, $component_title;
    /**
     * Create a new component instance.
     * @param string $componentId Id html del componente a renderizar
     * @param string $componentTitle Título del componente html a renderizar
     * @param Licitacion $licitacion Objeto de tipo licitacion
     * @param Fase $fase Objeto de tipo fase
     * @return void
     */
    public function __construct($componentId, $componentTitle, $licitacion, $modelo)
    {
        $this->licitacion = $licitacion;
        $this->modelo = $modelo;
        $this->component_id = $componentId;
        $this->component_title = $componentTitle;
        $this->repo = LicitacionFaseRepository::GetInstance();
        $this->licitacion_fase = $this->repo->findByParams([
            'licitacion' => $licitacion,
            'fase' => $modelo->id,
            'unico_registro' => true,
        ]);
        if($this->licitacion_fase != null){
            $docs_array = [];
            //Log::debug((array) $this->licitacion_fase);
            $documentos_licitacion = $this->licitacion_fase->documentoLicitacion();
            foreach($documentos_licitacion as $dl){
                array_push($docs_array, $dl->documento());
            }
            $this->documentos = collect($docs_array);
        }else{
            $this->documentos = collect([]);
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
        return view('components.fases-element');
    }
}
