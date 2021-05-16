<?php

namespace Database\Factories;

use App\Models\group;
use Illuminate\Database\Eloquent\Factories\Factory;

class groupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'time' => $this->faker->dateTimeBetween('-2 years'),
            'max_members' => 10,
        ];
    }
}
