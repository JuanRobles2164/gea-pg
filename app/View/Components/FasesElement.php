<?php

namespace App\View\Components;

use App\Repositories\LicitacionFase\LicitacionFaseRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class FasesElement extends Component
{
    public $modelo, $licitacion, $documentos, $documentos_licitacion;
    private $repo;
    public $licitacion_fase, $docs_necesita_asociar;

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
            //Log::debug((array) $this->licitacion_fase);
            $documentos_licitacion = $this->licitacion_fase->documentoLicitacion();
            //Docs Array son todos los documentos adjuntos a la licitacion
            foreach($documentos_licitacion as $dl){
                array_push($docs_array, $dl->documento());
            }
            //Tipos documentos son los documentos que se requieren en una licitación
            $tipo_documentos = $this->licitacion_fase->fase()->faseTipoDocumento();
            foreach($tipo_documentos as $td){
                array_push($docs_lic_array, $td->tipoDocumento());
            }
            //Docs que están ya asociados a la licitación
            $this->documentos = collect($docs_array);
            //Docs que se requieren para asociar a la licitación
            $this->documentos_licitacion = collect($docs_lic_array);
            //Itero sobre los documentos que deben estar cargados, evaluando sobre los que ya están cargados, verificando que tengan alguna existencia
            //si no encuentra el documento, lo agrego al array "docs que necesita agregar"
            $docs_necesita_asociar = [];
            foreach($this->documentos_licitacion as $dl){
                $encontrado = false;
                foreach($this->documentos as $d){
                    //si no es un documento unico de la licitación, evaluará si es requerido
                    //para la licitación, y si es requerido pero no está cargado, le pedirá que lo cargue
                    if(($d->recurrente != null || $d->constante != null)){
                        if($d->tipoDocumento()->id == $dl->id){
                            $encontrado = true;
                        }
                    }
                }
                if(!$encontrado){
                    array_push($docs_necesita_asociar, $dl);
                }
            }
            $this->docs_necesita_asociar = collect($docs_necesita_asociar);
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
