<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Modules\Product\Models\Product;

class ProductFactory extends Factory{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),//
'price' => $this->faker->randomNumber(),
'state' => $this->faker->boolean(),
'created_at' => Carbon::now(),
'updated_at' => Carbon::now(),
        ];
    }
}
