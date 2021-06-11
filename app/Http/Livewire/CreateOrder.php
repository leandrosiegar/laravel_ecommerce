<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Departamento;

class CreateOrder extends Component
{
    public $address;
    public $reference;

    public $envio_type = 1;

    public $departamentos;
    public $ciudades = [];
    public $distritos = [];

    public $departamento_id = "";
    public $ciudad_id = "";
    public $distrito_id = "";

    public function mount() {
        $this->departamentos = Departamento::all();
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
