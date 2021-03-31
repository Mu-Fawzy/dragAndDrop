<?php

namespace Database\Factories;

use App\Models\Box;
use Illuminate\Database\Eloquent\Factories\Factory;

class BoxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Box::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'القسم '.$this->faker->unique()->numberBetween(1, 100),
            'order'  => $this->faker->unique()->numberBetween(1, 100),
            'admin_id'  => $this->faker->numberBetween(1, 2)
        ];
    }
}
