<?php

namespace Database\Factories;
use App\Models\Config;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ConfigFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Config::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $version = rand(1.0, 2.5);
        return [
            'version' => $version,

        ];
    }
}
