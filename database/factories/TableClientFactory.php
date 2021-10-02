<?php

namespace Database\Factories;

use App\Models\TableClient;
use Illuminate\Database\Eloquent\Factories\Factory;

class TableClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TableClient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numero_table' => $this->faker->unique()->word(),
        ];
    }
}
