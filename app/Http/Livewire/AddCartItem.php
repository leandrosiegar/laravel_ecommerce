<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddCartItem extends Component
{
    public $product;
    public $cantidad = 1;
    public $stock;

    public function mount() {
        $this->stock = $this->product->quantity;
    }

    public function incrementar() {
        $this->cantidad++;
    }

    public function decrementar() {
        $this->cantidad--;
    }


    public function render()
    {
        return view('livewire.add-cart-item');
    }
}
