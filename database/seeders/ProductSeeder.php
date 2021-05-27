<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // A mí de esta manera me parece mucho más complicado yo haría primero Product::factory(250)->create();
        // Y luego obtener todos los productos con Product::all y recorrerlo con un foreach e ir metiendo las 4 images para cada producto
        Product::factory(250)->create()->each(function(Product $product) {
            Image::factory(4)->create([
                'imageable_id' => $product->id,
                'imageable_type' => Product::class
            ]);
        });
    }
}
