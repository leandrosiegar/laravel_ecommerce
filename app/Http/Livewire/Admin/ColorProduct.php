<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use Livewire\Component;

use App\Models\ColorProduct as Pivot; // Lo llamamos Pivot para q no hay conflicto con el nombre de la clase

class ColorProduct extends Component
{
    public $product;
    public $colors;
    public $color_id;
    public $quantity;
    public $abrirModal = false;

    public $pivot_color_id;
    public $pivot_quantity;
    public $pivot;

    protected $listeners = ['borrar'];

    protected $rules = [
        'color_id' => 'required',
        'quantity' => 'required|numeric'
    ];

    public function mount() {
        $this->colors = Color::all();
    }

    public function editar(Pivot $pivot) {
        $this->abrirModal = true;
        $this->pivot = $pivot;
        $this->pivot_color_id = $pivot->color_id;
        $this->pivot_quantity = $pivot->quantity;

    }

    public function actualizar() {
        $this->pivot->color_id = $this->pivot_color_id;
        $this->pivot->quantity = $this->pivot_quantity;
        $this->pivot->save();
        $this->product = $this->product->fresh();
        $this->abrirModal = false;

    }

    public function guardar() {
        $this->validate();

        // attach para introd un reg en la tabla intermedia entre product y colors
        $this->product->colors()->attach([
            $this->color_id => [
                'quantity' => $this->quantity
            ]
        ]);
        $this->reset(['color_id', 'quantity']);
        $this->emit('guardado');

        $this->product = $this->product->fresh(); // para q salga actualizado en el listado
    }

    public function borrar(Pivot $pivot) {
        $pivot->delete();
        $this->product = $this->product->fresh();
    }

    public function render()
    {
        $product_colors = $this->product->colors;
        return view('livewire.admin.color-product', compact('product_colors'));
    }
}
