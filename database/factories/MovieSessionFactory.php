<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MovieSession>
 */
class MovieSessionFactory extends Factory
{

    public static $minute = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        MovieSessionFactory::$minute++;

        return [
            'movie_id' => rand(1, 10),
            'time' => '22:0' . MovieSessionFactory::$minute,
            'room_id' => 1
        ];
    }
}
