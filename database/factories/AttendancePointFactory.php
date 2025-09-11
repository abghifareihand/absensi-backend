<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttendancePoint>
 */
class AttendancePointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'      => $this->faker->company . ' Campus',
            'latitude'  => $this->faker->latitude(-6.5, -6.0),
            'longitude' => $this->faker->longitude(106.7, 107.0),
            'radius'    => $this->faker->numberBetween(30, 200),
        ];
    }
}
