<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

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
            'image' => 'categories/'.$this->faker->image('public/storage/categories',640,480, null,false)
        ];
    }
}
