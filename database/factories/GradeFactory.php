<?php

namespace Database\Factories;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'grade_level' => $this->faker->randomElement([
                '1st Mon White',
                '2nd Mon Red',
                '3rd Mon White/Yellow',
                '4th Mon Yellow',
                '5th Mon Yellow/Orange',
                '6th Mon Orange',
                '7th Mon Orange/Green',
                '6th Kyu White',
                '5th Kyu Yellow',
                '4th Kyu Orange',
                '1st Dan',
                '3rd Dan',
                '6th Dan',
                '7th Dan',
                '8th Dan'
            ]),
            'grade_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'grade_points' => $this->faker->numberBetween(1, 12),
            'member_id' => $this->faker->numberBetween(1, 516),
        ];
    }
}
