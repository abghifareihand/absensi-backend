<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'    => User::inRandomOrder()->first()->id ?? User::factory(),
            'title'      => $this->faker->sentence(3),
            'date'       => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'start_time' => $this->faker->time('H:i:s'),
            'end_time'   => $this->faker->time('H:i:s'),
            'location'   => $this->faker->randomElement(['Ruang A101', 'Ruang B202', 'Lab 3', 'Aula Kampus']),
        ];
    }
}
