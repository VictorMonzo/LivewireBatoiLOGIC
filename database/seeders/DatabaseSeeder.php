<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

use App\Models\Provider;
use App\Models\Product;
use App\Models\State;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // USERS
        User::create([
            'name' => 'Victor',
            'email' => 'victor.monzo.mora@gmail.com',
            'type_user' => 3,
            'password' => '$2y$10$GjPJlo8O5CoWY4pKbesFcueWv3IRebrgE9f59D.oOD0lYuq8MKnhy',
            'address' => 'C/ Correos Nº6 7ºB'
        ]);
        User::factory(5)->create();

        // PROVIDERS
        Provider::factory(3)->create();

        // PRODUCTS
        $providers = Provider::all();
        $providers->each(function ($provider) {
            Product::factory()->count(4)->create([
                'provider_id' => $provider->id
            ]);
        });

        // STATES
        $statesAdd = ['En proceso', 'En camino', 'Entregado', 'Sin stock'];
        foreach($statesAdd as $state) {
            State::create([
                'name' => $state
            ]);
        };

        // ORDERS
        $users = User::all('id');
        $states = State::all('id');
        $products = Product::all('id', 'price');

        Order::factory()->count(4)->create([
            'user_id' => $users[random_int(0, count($users))],
            'state' => $states[random_int(0, count($states))],
            'price' => $products[random_int(0, count($products))]->price,
            'product_id' => $products[random_int(0, count($products))]->id
        ]);
    }
}
