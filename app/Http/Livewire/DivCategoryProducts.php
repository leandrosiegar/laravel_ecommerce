<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DivCategoryProducts extends Component
{
    public $category;

    public function render()
    {
        return view('livewire.div-category-products');
    }
}