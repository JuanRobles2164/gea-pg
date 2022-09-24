<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GuardarCliente extends Component
{
    public $modal_title;
    public $modal_id;
    public $modelo = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalTitle, $identificadorModal, $idElemento = -1, $dataModelo = [])
    {
        $this->modal_title = $modalTitle;
        $this->modal_id = $identificadorModal;

        if($idElemento == -1 || $idElemento == '-1'){
            $this->modelo["id"] = null;
        }else{
            $this->modelo = $idElemento;
        }
        
        $this->modelo['razon_social'] = isset($dataModelo['razon_social']) ? $dataModelo['razon_social'] : "";
        $this->modelo["identificacion"] = isset($dataModelo['identificacion']) ? $dataModelo['identificacion'] : "";
        $this->modelo['tipo_identificacion'] = isset($dataModelo['tipo_identificacion']) ? $dataModelo['tipo_identificacion'] : "";
        $this->modelo['estado'] = isset($dataModelo['estado']) ? $dataModelo['estado'] : "";
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
