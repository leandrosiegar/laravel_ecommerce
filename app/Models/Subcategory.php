<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'update_at']; // guarded es lo contrario a fillable, es decir, metemos lo q no queremos por asign masiva

    // relación de uno a muchos
    public function products() {
        return $this->hasMany(Product::class);
    }

    // relación de uno a muchos (inversa)
    public function category() {
        return $this->belongsTo(Category::class);
    }


}
