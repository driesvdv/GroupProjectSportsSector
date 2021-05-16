<?php

namespace Database\Factories;

use App\Models\sportSession;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class sportSessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = sportSession::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startTime = $this->faker->dateTimeInInterval('-1 years', '+7 days');

        return [
            'start_time' => $startTime,
            'end_time' => Carbon::parse($startTime)->addHour(),
        ];
    }
}
