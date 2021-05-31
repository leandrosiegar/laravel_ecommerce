<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class BarraNaveg extends Component
{
    public function render()
    {
        $categories = Category::all();

        return view('livewire.barra-naveg', compact('categories'));
    }
}
