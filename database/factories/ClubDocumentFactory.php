<?php

namespace Database\Factories;

use App\Models\ClubDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClubDocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClubDocument::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'link' => $this->faker->imageUrl(800, 600, 'business'),
            'type' => $this->faker->randomElement(['Document','Form'] ),
            'club_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
