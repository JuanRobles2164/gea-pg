<?php

namespace App\View\Components;

use App\Repositories\TipoDocumento\TipoDocumentoRepository;
use Illuminate\View\Component;

class NuevoArchivoFaseLicitacionModal extends Component
{
    private $repo;
    public $tipos_doc;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->repo = TipoDocumentoRepository::GetInstance();
        $this->tipos_doc = $this->repo->getAll();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nuevo-archivo-fase-licitacion-modal');
    }
}
