<?php

namespace Database\Factories;

use App\Models\Club;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClubFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Club::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company,
            'address1' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'county' => $this->faker->state,
            'province' => $this->faker->state,
            'type' => $this->faker->randomElement(['School Club', 'Ordinary Club', 'University Club']),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->companyEmail,
            'compliant' => $this->faker->randomElement([0,1]),
            'voting_rights' => $this->faker->randomElement([0,1]),
        ];
    }
}
