<?php

namespace Database\Factories;

use App\Models\Rule;
use App\Models\Espa;
use Illuminate\Database\Eloquent\Factories\Factory;

class RuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'espa_id' => Espa::factory(),
            'name' => $this->faker->name
        ];
    }
}
