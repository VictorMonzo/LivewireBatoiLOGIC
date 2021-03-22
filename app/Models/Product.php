<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock', 'active', 'photo', 'provider_id'];

    // Crear relación Uno a muchos con la tabla OrderLines
    public function orders() {
        return $this->hasMany('App\Models\Product');
    }

    // Crear relación Uno a muchos con la tabla Providers
    public function providers() {
        return $this->belongsTo('App\Models\Provider', 'provider_id');
    }
}
