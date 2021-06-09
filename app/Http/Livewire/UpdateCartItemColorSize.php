<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class UpdateCartItemColorSize extends Component
{
    // el valor de $rowId se pasa cuando se instacia el componente
    public $rowId;

    public $cantidad;
    public $stock;

    // mount es el constructor del componente
    public function mount() {
        $item = Cart::get($this->rowId);
        $this->cantidad = $item->qty;
        $this->stock = cantidadDisponible($item->id, $item->options->color_id, $item->options->size_id);
    }

    public function incrementar() {
        $this->cantidad++;
        Cart::update($this->rowId, $this->cantidad); // actualizar ese campo en carrito
        $this->emit('render'); // llamamos al método render de dropdownCarrito para q se actualice
    }

    public function decrementar() {
        $this->cantidad--;
        Cart::update($this->rowId, $this->cantidad); // actualizar ese campo en carrito
        $this->emit('render'); // llamamos al método render de dropdownCarrito para q se actualice
    }

    public function render()
    {
        return view('livewire.update-cart-item-color-size');
    }
}
