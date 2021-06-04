<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddCartItemColor extends Component
{
    // product y colors se van a pasar por parámetros al crear este componente
    public $product;
    public $colors;

    public $cantidad = 1;
    public $stock = 0;
    public $colorSelected = "";

    public function mount() {
        $this->colors = $this->product->colors;
    }

    public function render()
    {
        return view('livewire.add-cart-item-color');
    }

    // automáticamente solo con poner updated al nombre de la función ya se ejecuta cada vez q haya
    // un cambio en esa propiedad (en este caso colorSelected)
    public function updatedColorSelected($value) {
        // pivot te trae la información q hay en la tabla intermedia de muchos a muchos q hay
        // entre products y colors
        $this->stock = $this->product->colors->find($value)->pivot->quantity;

    }
}
