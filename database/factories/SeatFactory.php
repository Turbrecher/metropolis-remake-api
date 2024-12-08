<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
{

    static $col = 0;
    static $row = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            'seat',
            'corridor'
        ];

        $type = 'seat';




        SeatFactory::$col++;

        if (SeatFactory::$col > 9) {
            SeatFactory::$col = 1;
        }


        if (SeatFactory::$col == 1) {
            SeatFactory::$row++;
        }


        if (SeatFactory::$col == 3 || SeatFactory::$col == 4 || SeatFactory::$col == 7 || SeatFactory::$col == 8) {
            $type = 'corridor';

        } else {
            $type = 'seat';
        }



        return [
            'row' => SeatFactory::$row,
            'col' => SeatFactory::$col,
            'room_id' => 1,
            'type' => $type
        ];
    }
}
