<?php

namespace App\View\Components;

use App\Repositories\Cliente\ClienteRepository;
use Illuminate\View\Component;

class GuardarCliente extends Component
{
    public $modal_title;
    public $modal_id;
    public $modelo;
    private $repo = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalTitle = 'Formulario de Clientes', $identificadorModal, $idElemento = -1)
    {
        $this->modal_title = $modalTitle;
        $this->modal_id = $identificadorModal;

        if($idElemento != -1 || $idElemento != '-1'){
            $this->repo = ClienteRepository::GetInstance();
            $this->modelo = $this->repo->find($idElemento);
            $this->repo = null;
        }else{
            $this->modelo = null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.guardar-cliente');
    }
}
