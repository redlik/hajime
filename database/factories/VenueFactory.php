<?php

namespace Database\Factories;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

class VenueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Venue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'address1' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'county' => $this->faker->state,
            'eircode' => $this->faker->postcode,
            'phone' => $this->faker->phoneNumber,
            'contact' => $this->faker->name,
            'club_id' => $this->faker->numberBetween(1, 50),

        ];
    }
}
