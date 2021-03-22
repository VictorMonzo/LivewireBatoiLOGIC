<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['state', 'address', 'quantity', 'price', 'user_id', 'product_id'];

    // Crear relación Uno a muchos con la tabla Users
    public function users() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function states() {
        return $this->belongsTo('App\Models\State', 'state');
    }

    // Crear relación Uno a muchos con la tabla Products
    public function products() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
