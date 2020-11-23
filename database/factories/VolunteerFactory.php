<?php

namespace Database\Factories;

use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Factories\Factory;

class VolunteerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Volunteer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'vetting_completion' => $this->faker->dateTimeBetween('-2 years', '+1 year'),
            'vetting_expiry' => $this->faker->dateTimeBetween('-2 years', '+1 year'),
            'safeguarding_completion' => $this->faker->dateTimeBetween('-2 years', '+1 year'),
            'safeguarding_expiry' => $this->faker->dateTimeBetween('-2 years', '+1 year'),
            'club_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
