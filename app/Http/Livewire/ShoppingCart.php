<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingCart extends Component
{
    // los listeners son para poder llamar a métodos de este componente desde otro componente mediante emit
    protected $listeners = ['render'];

    public function borrarCarrito() {
        Cart::destroy();
        $this->emitTo('dropdown-carrito', 'render'); // q ejecute el método render del componente dropdown-carrito
    }

    public function borrarItem($rowId) {
        Cart::remove($rowId);
        $this->emitTo('dropdown-carrito', 'render'); // q ejecute el método render del componente dropdown-carrito

    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
