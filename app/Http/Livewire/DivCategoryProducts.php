<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DivCategoryProducts extends Component
{
    public $category;
    public $products = [];

    public function cargarPosts() {
        $this->products = $this->category->products()->where('status',2)->limit(15)->get();

        $this->emit("ejecutarGlider", $this->category->id); // emit es siempre para llamar a un evento
    }

    public function render()
    {
        return view('livewire.div-category-products');
    }
}
