<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cost_envio', 'departamento_id'];

    // Relación uno a muchos
    public function distritos() {
        return $this->hasMany(Distrito::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
