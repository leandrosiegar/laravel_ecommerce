<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subcategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Importante, siempre a la hora de subir las imágenes hay q tener creado antes el acceso directo a storage
        // (si no estuviera se hace con: php artisan storage:link)
        // y en config\filesystems.php: 'default' => env('FILESYSTEM_DRIVER', 'public'),
        return [
            'image' => 'subcategories/'.$this->faker->image('public/storage/subcategories',640,480, null,false)
        ];
    }
}
