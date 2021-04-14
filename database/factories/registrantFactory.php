<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\registrant;

class registrantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = registrant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->firstOrFail()->id,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birth_date' => $this->faker->date('Y-m-d'),
            'max_registrations' => 1,
        ];
    }
}
