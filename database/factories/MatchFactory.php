<?php

namespace Database\Factories;

use App\Models\Match;
use App\Models\Rule;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Match::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'rule_id' => Rule::factory(),
            'what' => $this->faker->name,
            'text' => $this->faker->title

        ];
    }
}
