<?php

namespace Database\Factories;

use App\Models\Membernote;
use Illuminate\Database\Eloquent\Factories\Factory;

class MembernoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Membernote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'body' => $this->faker->realText(120),
            'slug' => $this->faker->slug(4),
            'member_id' => $this->faker->numberBetween(1,300),
        ];
    }
}
