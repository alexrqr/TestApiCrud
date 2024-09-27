<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recets;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recets>
 */
class RecetsFactory extends Factory
{
    protected $table = Recets::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=> $this->faker->sentence(),
            'descripcion' => $this->faker->text(),
        ];
    }
}
