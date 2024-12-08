<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $actors = [
            'Joe',
            'Matt',
            'Oliver',
            'Mark',
            'Frieren',
            'Himmel'
        ];

        $directors = [
            'Zack Snyder'
        ];

        $genres = [
            'Fantasy',
            'Horror',
            'Science Fiction',
            'Super Powers',
            'Super heroes',
        ];

        $pegi = [
            '+3',
            '+7',
            '+12',
            '+16',
            '+18',
        ];


        return [
            "title" => fake()->words(12, true),
            "synopsis" => fake()->words(200, true),
            "actors" => $actors[1],
            "directors" => $directors[0],
            "duration" => rand(60, 150),
            "releaseDate" => fake()->date('Y.m.d'),
            "genres" => $genres[rand(0, count($genres) - 1)],
            "pegi" => $pegi[rand(0, count($pegi) - 1)],
            "portrait" => 'default.png'
        ];
    }
}
