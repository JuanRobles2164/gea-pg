<?php
namespace App\View\Components;

use App\Repositories\Cliente\ClienteRepository;
use Illuminate\View\Component;
use App\Enums\TipoIdentificacionEnum;

class GuardarCliente extends Component
{
    public $modal_title;
    public $modal_id;
    public $model;
    public $tipo_ident;
    private $repo = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalTitle = 'Formulario de Clientes', $modalId, $modelId = -1)
    {
        $this->modal_title = $modalTitle;
        $this->modal_id = $modalId;
        $this->tipo_ident = TipoIdentificacionEnum::getEnum();

        if($modelId != -1 || $modelId != '-1'){
            $this->repo = ClienteRepository::GetInstance();
            $this->model = $this->repo->find($modelId);
            $this->repo = null;
        }else{
            $this->model = null;
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
