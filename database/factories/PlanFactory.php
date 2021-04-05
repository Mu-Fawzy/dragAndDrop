<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => 'الخطة '.$this->faker->unique()->numberBetween(1, 150),
            'description'  => 'تفاصيل الخطة الاولى',
            'admin_id'  => $this->faker->numberBetween(1, 2)
        ];
    }
}
