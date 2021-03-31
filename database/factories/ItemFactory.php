<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => 'العنصر '.$this->faker->unique()->numberBetween(1, 100),
            'info'  => 'معلومات العنصر',
            'order'  => $this->faker->unique()->numberBetween(1,100),
            'box_id'    => $this->faker->numberBetween(1,2),
            'admin_id'  => $this->faker->numberBetween(1, 2)
        ];
    }
}
