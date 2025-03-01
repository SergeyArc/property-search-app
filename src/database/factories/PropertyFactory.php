<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'price' => $this->faker->numberBetween(10000),
            'bedrooms' => $this->faker->randomNumber(),
            'bathrooms' => $this->faker->randomNumber(),
            'storeys' => $this->faker->randomNumber(),
            'garages' => $this->faker->randomNumber(),
        ];
    }
}
