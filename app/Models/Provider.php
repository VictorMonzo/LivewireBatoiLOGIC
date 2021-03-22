<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    // Crear relación Uno a muchos con la tabla Products
    public function products() {
        return $this->hasMany('App\Models\Product');
    }
}
