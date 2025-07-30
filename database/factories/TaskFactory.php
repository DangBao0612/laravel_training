<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = \App\Models\Task::class;

    public function definition(): array
    {
        return [
            'user_id'   => User::factory(),                 // liên kết với User
            'title'     => $this->faker->sentence(4),
            'completed' => $this->faker->boolean(),
        ];
    }
}
