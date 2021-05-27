<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Accedemos a la relación subcategory del modelo Product
        // Así nos ahorramos hacer querys mucho más largas y complejas
        $products = Product::whereHas('subcategory', function(Builder $query) {
            $query->where('color', true)
                ->where('size', true);
        })->get();

        $sizes = ['Talla S', 'Talla M', 'Talla L'];
        foreach ($products as $product) {
            foreach ($sizes as $size) {
                $product->sizes()->create([
                    'name' => $size
                ]);
            }
        }
    }
}
