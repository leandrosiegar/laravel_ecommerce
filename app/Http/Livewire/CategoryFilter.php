<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends Component
{
    use WithPagination;

    public $category;
    public $subcategorySelected;
    public $brandSelected;
    public $viewSelected = "grid";


    public function limpiarFiltros() {
        $this->reset(['subcategorySelected', 'brandSelected']);
    }

    public function render()
    {
        /*
        $products = $this->category->products()
                ->where('status',2)
                ->paginate(20);
                */

        // se hace así con whereHas pq no hay una relación directamente producto y categoría
        $productsQuery = Product::Query()->whereHas('subcategory.category', function(Builder $query) {
            $query->where('id', $this->category->id);
        });

        if ($this->subcategorySelected) { // si existe algún valor en esa variable
            $productsQuery = $productsQuery->whereHas('subcategory', function(Builder $query) {
                $query->where('name', $this->subcategorySelected);
            });
        }

        if ($this->brandSelected) {
            $productsQuery = $productsQuery->whereHas('brand', function(Builder $query) {
                $query->where('name', $this->brandSelected);
            });
        }

        $products = $productsQuery->paginate(20);


        return view('livewire.category-filter', compact('products'));
    }
}
