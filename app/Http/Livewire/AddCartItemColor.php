<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemColor extends Component
{
    // product y colors se van a pasar por parámetros al crear este componente
    public $product;
    public $colors;

    public $cantidad = 1;
    public $stock = 0;
    public $colorSelected = "";

    public $options = [];

    public function mount() {
        $this->colors = $this->product->colors;
        $this->options['rutaImagen'] = Storage::url($this->product->images->first()->url);
    }

    public function incrementar() {
        $this->cantidad++;
    }

    public function decrementar() {
        $this->cantidad--;
    }

    // automáticamente solo con poner updated al nombre de la función ya se ejecuta cada vez q haya
    // un cambio en esa propiedad (en este caso colorSelected)
    public function updatedColorSelected($value) {
        // pivot te trae la información q hay en la tabla intermedia de muchos a muchos q hay
        // entre products y colors
        $color = $this->product->colors->find($value);
        $this->stock = $color->pivot->quantity;
        $this->options['color'] = $color->name;
    }

    public function addItem() {
        // id, name, qty, price y weight son campos obligatorios del paquete de shoppingcart
        Cart::add(
            [
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->cantidad,
            'price' => $this->product->price,
            'weight' => 550,
            'options' => $this->options
        ]);

        // emitTo hace que se ejecute solo el componente dropdown-carrito, si se pusiera solo emit lo escucharía todos
        $this->emitTo('dropdown-carrito', 'render');
    }



    public function render()
    {
        return view('livewire.add-cart-item-color');
    }




}
