<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;

use Livewire\Component;

use App\Models\ColorSize as Pivot; // lo renombramos para q no haya confusion con el nombre de la clase del componente

class ColorSize extends Component
{

    public $size; // la q se envía al crear el componente

    public $colors;
    public $color_id;
    public $quantity;
    public $pivot;
    public $abrirModal = false;
    public $pivot_color_id;
    public $pivot_quantity;

    protected $rules = [
        'color_id' => 'required',
        'quantity' => 'required|numeric'
    ];

    public function mount() {
        $this->colors = Color::all();
    }

    public function guardar() {
        $this->validate();


        $pivot = Pivot::where('color_id', $this->color_id)
                    ->where('size_id', $this->size->id)
                    ->first();

        if ($pivot) { // existe alguno
            $pivot->quantity = $pivot->quantity + $this->quantity;
            $pivot->save();
        }
        else {
           // attach para introd un reg en la tabla intermedia entre size y colors
            $this->size->colors()->attach([
                $this->color_id => [
                    'quantity' => $this->quantity
                ]
            ]);
        }

        $this->reset(['color_id', 'quantity']);
        $this->emit('guardado');

        $this->size = $this->size->fresh(); // para q salga actualizado en el listado
    }

    public function editar(Pivot $pivot) {
        $this->pivot = $pivot;
        $this->pivot_color_id = $pivot->color_id;
        $this->pivot_quantity = $pivot->quantity;
        $this->abrirModal = true;
    }

    public function actualizar() {
        $this->pivot->color_id = $this->pivot_color_id;
        $this->pivot->quantity = $this->pivot_quantity;
        $this->pivot->save();
        $this->size = $this->size->fresh();
        $this->abrirModal = false;
    }

    public function render()
    {
        $size_colors = $this->size->colors;
        return view('livewire.admin.color-size', compact('size_colors'));
    }
}
