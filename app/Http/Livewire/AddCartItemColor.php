<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemColor extends Component
{
    // product y colors se van a pasar por parámetros al crear este componente
    // se crea desde resources\views\products\show.blade.php
    public $product;
    public $colors;

    public $cantidad = 1;
    public $stock = 0;
    public $colorSelected = "";

    public $options = [
        'color_id' => null,
        'size_id' => null
    ];

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

        $color = $this->product->colors->find($value);
        // llamamos a la funcion en nuestros app/helpers.php
        $this->options['color_id'] = $color->id;
        $this->options['color_name'] = $color->name;
        $this->stock = cantidadDisponible($this->product->id, $color->id);

        // dd("AQUI LLEGA");
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

        // actualizar el stock
        // dd($this->colorSelected);
        // dd($this->colors);
        $this->stock = cantidadDisponible($this->product->id, $this->colorSelected);

        $this->reset('cantidad');

        // emitTo hace que se ejecute solo el componente dropdown-carrito, si se pusiera solo emit lo escucharía todos
        $this->emitTo('dropdown-carrito', 'render');
    }



    public function render()
    {
        return view('livewire.add-cart-item-color');
    }




}
