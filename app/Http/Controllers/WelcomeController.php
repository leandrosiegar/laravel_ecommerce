<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class WelcomeController extends Controller
{
    // la función de __invoke se usa cuando el controller va a tener un único método
    public function __invoke() {
        $categories = Category::all();
        return view('welcome', compact('categories'));
    }
}
