<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

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
            'address1' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'county' => $this->faker->state,
            'province' => $this->faker->state,
            'dob' => $this->faker->date,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'mobile' => $this->faker->phoneNumber,
            'gender' => $this->faker->randomElement(['Female','Male']),
            'club_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
