<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalDocumentosFaseAgregarLicitacion extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal-documentos-fase-agregar-licitacion');
    }
}
