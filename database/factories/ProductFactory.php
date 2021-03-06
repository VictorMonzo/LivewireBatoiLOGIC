<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->userName(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1000),
            'stock' => $this->faker->numberBetween($min = 0, $max = 400),
            'active' => $this->faker->numberBetween($min = 0, $max = 1),
            'photo' => 'https://images2.alphacoders.com/474/thumb-350-474157.jpg',
        ];
    }
}
