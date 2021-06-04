<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\Color;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ColorSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // con el attach no consigo q funcione
        $sizes = Size::all();
        $colors = Color::all();
        // DB::insert('insert into color_size(color_id, size_id, quantity) values (?, ?,?)', [1, 1, 12]);
        foreach ($colors as $color) {
            foreach ($sizes as $size) {
                DB::insert('insert into color_size(color_id, size_id, quantity) values (?, ?,?)', [$color->id, $size->id, 15]);
            }
        }

            /*
            $size->colors()->attach(
                [
                1 => ['quantity' => 10],
                2 => ['quantity' => 11],
                3 => ['quantity' => 12],
                4 => ['quantity' => 13],
                ]
            );
            */
    }
}
