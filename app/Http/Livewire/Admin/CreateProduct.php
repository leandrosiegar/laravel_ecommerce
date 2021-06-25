<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

use Illuminate\Support\Str;

class CreateProduct extends Component
{
    public $categories;
    public $subcategories = [];
    public $category_id = "";
    public $subcategory_id = "";
    public $brand_id;
    public $name;
    public $slug;
    public $description = "";
    public $brands = [];
    public $price;
    public $quantity;

    protected $rules = [
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'name' => 'required',
        'slug' => 'required|unique:products',
        'description' => 'required',
        'brand_id' => 'required',
        'price' => 'required',
    ];

    public function mount() {
        $this->categories = Category::all();
    }

    public function updatedCategoryId($value) {
        $this->subcategories = Subcategory::where('category_id', $value)->get();

        // whereHas es cuando hay una tabla intermedia pq la relacion es muchos a muchos
        $this->brands = Brand::whereHas('categories', function(Builder $query) use ($value) {
            $query->where('category_id', $value);
        })->get();

        $this->reset(['subcategory_id', 'brand_id']);
    }

    public function updatedName($value) {
        $this->slug = Str::slug($value);
    }

    public function getSubcategoryProperty() {
        return Subcategory::find($this->subcategory_id);
    }

    public function guardar() {
        $rules = $this->rules;
        if ($this->subcategory_id) {
            if (!$this->subcategory->color && !$this->subcategory->size) { // ambos están a cero
                $rules['quantity'] = 'required';
            }
        }
        $this->validate($rules);

        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->description = $this->description;
        $product->subcategory_id = $this->subcategory_id;
        $product->brand_id = $this->brand_id;
        $product->price = $this->price;
        if ($this->subcategory_id) {
            if (!$this->subcategory->color && !$this->subcategory->size) { // ambos están a cero
                $product->quantity = $this->quantity;
            }
        }
        $product->save();

        return redirect()->route('admin.product.edit', $product);
    }

    public function render()
    {

        return view('livewire.admin.create-product')->layout('layouts.admin');
    }
}
