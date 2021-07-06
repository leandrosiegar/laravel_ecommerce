<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

use Livewire\WithFileUploads; // para poder tratar con ficheros FILE

class CreateCategory extends Component
{

    use WithFileUploads;

    public $brands;
    public $rand; // para q se actulice el campo file (pq sino nunca se borra cuando se da de alta)
    public $createform = [
        'name' => null,
        'slug' => null,
        'icon' => null,
        'image' => null,
        'brands' => []
    ];

    protected $rules = [
        'createform.name' => 'required',
        'createform.slug' => 'required|unique:categories,slug', // debe ser unico en la tabla categories en el campo slug
        'createform.icon' => 'required',
        'createform.image' => 'required|image|max:1024',
        'createform.brands' => 'required',

    ];

    protected $validationAttributes = [ // para q los mensajes de error estén personalizados
        'createform.name' => 'Nombre',
        'createform.slug' => 'Slug',
        'createform.icon' => 'Icono',
        'createform.image' => 'Imagen',
        'createform.brands' => 'Marcas',
    ];

    public function mount() {
        $this->getBrands();
        $this->rand = rand();
    }

    public function getBrands() {
        $this->brands = Brand::all();
    }

    // cada vez q cambie el campo name se llama automáticamente a esta función
    public function updatedCreateformName($value) {
        $this->createform["slug"] = Str::slug($value);
    }

    public function save() {
        // dd($this->createform["brands"]);
        $this->validate();
        $image = $this->createform["image"]->store('categories'); // subirla a la carpeta
        $category = Category::create([
            'name' => $this->createform["name"],
            'slug' => $this->createform["slug"],
            'icon' => $this->createform["icon"],
            'image' => $image
        ]);

        // introducir un reg en la tabla interm entre categ y brand (pq es relac mucho a mucho)
        /*
        // No se pq con el attach no funciona
        $category->brands()->attach([
            $this->createform["brands"]
        ]);
        */
        // dd($category->id);
        foreach ($this->createform["brands"] as $brand) {
            DB::table('brand_category')->insert([
                'brand_id' => $brand,
                'category_id' => $category->id
            ]);


        }


        $this->reset('createform');
        $this->rand = rand(); // para q se limpie el file


    }

    public function render()
    {
        return view('livewire.admin.create-category');
    }
}
