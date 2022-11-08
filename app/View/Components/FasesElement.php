<?php

namespace App\View\Components;

use App\Http\Util\Utilidades;
use App\Repositories\LicitacionFase\LicitacionFaseRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class FasesElement extends Component
{
    public $modelo, $licitacion, $documentos, $documentos_licitacion;
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
        $this->licitacion_fase = $this->repo->find($modelo->id);
        if($this->licitacion_fase != null){
            $docs_array = [];
            $docs_lic_array = [];
            $documentos_licitacion = $this->licitacion_fase->documentoLicitacion();
            foreach($documentos_licitacion as $dl){
                $objDocumento = Utilidades::completarNumeracionDocumento($dl->documento()->tipo_documento, $dl->documento());
                array_push($docs_array, $objDocumento);
            }
            //Log::debug((array)$docs_array);
            $tipo_documentos = $this->licitacion_fase->fase()->faseTipoDocumento();
            foreach($tipo_documentos as $td){
                array_push($docs_lic_array, $td->tipoDocumento());
            }
            $this->documentos = collect($docs_array);
            $this->documentos_licitacion = collect($docs_lic_array);
        }else{
            $this->documentos = collect([]);
            $this->documentos_licitacion = collect([]);
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
