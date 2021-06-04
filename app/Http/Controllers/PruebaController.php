<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

use App\Models\Size;
use Illuminate\Support\Facades\DB;

class PruebaController extends Controller
{
    public function show() {
        $sizes = Size::all();
        $colors = Color::all();
        foreach ($colors as $color) {
            foreach ($sizes as $size) {
                DB::insert('insert into color_size(color_id, size_id, quantity) values (?, ?,?)', [$color->id, $size->id, 10]);
            }
        }
    }
}
