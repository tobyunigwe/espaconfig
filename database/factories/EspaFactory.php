<?php

namespace Database\Factories;
use App\Models\Espa;
use App\Models\Config;
use Illuminate\Database\Eloquent\Factories\Factory;

class EspaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Espa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        $config_id = rand(1, 10);
        $enabled = rand(0, 1);
        return [
            'config_id' => Config::factory(),
            'enabled' => $enabled
        ];
    }
}
