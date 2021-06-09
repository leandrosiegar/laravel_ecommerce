<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;


class UpdateCartItem extends Component
{
    // el valor de $rowId se pasa cuando se instacia el componente
    public $rowId;

    public $cantidad;
    public $stock;

    // mount es como el constructor, el método q se ejecuta cuando se instancia el componente
    public function mount() {
        $item = Cart::get($this->rowId);

        $this->cantidad = $item->qty;

        $this->stock = cantidadDisponible($item->id);
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
        return view('livewire.update-cart-item');
    }
}
