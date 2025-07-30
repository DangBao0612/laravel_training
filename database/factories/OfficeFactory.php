<?php

namespace Database\Factories;
// Factory của model Office
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Office>
 */
class OfficeFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Office',
        ];
    }
}
