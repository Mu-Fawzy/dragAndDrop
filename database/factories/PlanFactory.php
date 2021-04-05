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
        $name_slug = 'الخطة '.$this->faker->unique()->numberBetween(1, 150);
        return [
            'name'  => $name_slug,
            'slug'  => $this->my_slug($name_slug),
            'description'  => 'تفاصيل الخطة الاولى',
            'admin_id'  => $this->faker->numberBetween(1, 2)
        ];
    }

    private function my_slug($string, $separator = '-')
    {
        $string = trim($string);
        $string = mb_strtolower($string, 'UTF-8');

        // Remove multiple dashes or whitespaces or underscores
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]+/", " ", $string);
        // Convert whitespaces and underscore to the given separator
        $string = preg_replace("/[\s_]/", $separator, $string);

        return rawurldecode($string);
    }
}
