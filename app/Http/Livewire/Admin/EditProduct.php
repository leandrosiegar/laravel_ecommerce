<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use Livewire\Component;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EditProduct extends Component
{
    public $product;
    public $categories;
    public $subcategories;
    public $brands;
    public $category_id;

    // para cuando se llame desde javascript con emit
    protected $listeners = ['refreshProduct', 'borrarProducto'];

    protected $rules = [
        'category_id' => 'required',
        'product.subcategory_id' => 'required',
        'product.name' => 'required',
        'product.slug' => '',
        'product.description' => 'required',
        'product.brand_id' => 'required',
        'product.price' => 'required',
        'product.quantity' => 'numeric'
    ];

    public function mount(Product $product) {
        $this->product = $product;
        $this->categories = Category::all();
        $this->category_id = $product->subcategory->category->id;
        $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();
        // whereHas es cuando hay una tabla intermedia pq la relacion es muchos a muchos
        $this->brands = Brand::whereHas('categories', function(Builder $query) {
            $query->where('category_id', $this->category_id);
        })->get();
    }

    public function getSubcategoryProperty() {
        return Subcategory::find($this->product->subcategory_id);
    }

    public function updatedCategoryId($value) {
        $this->subcategories = Subcategory::where('category_id', $value)->get();

        // whereHas es cuando hay una tabla intermedia pq la relacion es muchos a muchos
        $this->brands = Brand::whereHas('categories', function(Builder $query) use ($value) {
            $query->where('category_id', $value);
        })->get();

        // $this->reset(['subcategory_id', 'brand_id']);
        $this->product->subcategory_id = "";
        $this->product->brand_id = "";
    }

    public function refreshProduct() {
        $this->product = $this->product->refresh();
    }

    public function borrarProducto() {
        $images = $this->product->images;
        foreach ($images as $image) {
            Storage::delete($image->url); // borrarla físicamente la carpeta
            $image->delete(); // borrarlo de la BD
        }
        $this->product->delete();
        return redirect()->route('admin.index');
    }

    // cada vez q cambie el valor de product.name
    public function updatedProductName($value) {
        $this->product->slug = Str::slug($value);
    }

    public function guardar() {
        $rules = $this->rules;

        // hacer q podamos modificar aunque tenga el mismo slug aunque ya esté en la BD
        // busca en la tabla products en la columna slug y con ese id concreto
        $rules['product.slug'] = 'required|unique:products,slug,'.$this->product->id;


        if ($this->product->subcategory_id) {
            // con $this->subcategory acceder por defecto a getSubcategoryProperty (no me gusta nada hacerlo así)
            if (!$this->subcategory->color && !$this->subcategory->size) { // ambos están a cero
                $rules['product.quantity'] = 'required|numeric';
            }
            $this->validate($rules);
        }
        $this->product->save();
        $this->emit('guardado');
    }

    public function deleteImagen(Image $image) {
        Storage::delete([$image->url]); // eliminarla físicamente
        $image->delete(); // borrar de la BD
        $this->product = $this->product->fresh();
    }

    public function render()
    {
        return view('livewire.admin.edit-product')->layout('layouts.admin');
    }
}
