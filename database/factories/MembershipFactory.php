<?php

namespace Database\Factories;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;

class MembershipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Membership::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'membership_type' => $this->faker->randomElement([
                'Under 12 – Junior Membership',
                'Under 18 – Youth Membership',
                'Over 18 – Adult Membership',
                'Student Membership',
                'Life Membership']),
            'join_date' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'expiry_date' => $this->faker->date('2021-12-31'),
            'member_id' => $this->faker->numberBetween(1, 516)
        ];
    }
}
