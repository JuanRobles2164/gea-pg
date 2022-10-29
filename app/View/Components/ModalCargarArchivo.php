<?php

namespace App\View\Components;

use App\Repositories\TipoDocumento\TipoDocumentoRepository;
use Illuminate\View\Component;

class ModalCargarArchivo extends Component
{

    public $tipos_documentos;
    private $repo;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->repo = TipoDocumentoRepository::GetInstance();
        $this->tipos_documentos = $this->repo->getAll();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-cargar-archivo');
    }
}
