<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'movie_session_id' => rand(1, 9),
            'user_id' => 1,
            'date' => fake()->date('Y-m-d'),
            'seat_id'=>rand(1,81)
        ];
    }
}
