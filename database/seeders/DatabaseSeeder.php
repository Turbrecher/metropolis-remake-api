<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\MovieSession;
use App\Models\Product;
use App\Models\Room;
use App\Models\Seat;
use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);



        $user = new User();
        $user->assignRole('admin');
        $user->email = 'victor@correo.es';
        $user->name = 'Victor';
        $user->surname = 'Vera';
        $user->username = 'vittorio';
        $user->password = Hash('sha256', '12345678');

        $user->save();


        Movie::factory(10)->create();
        Room::factory(1)->create();
        Seat::factory(81)->create();
        MovieSession::factory(10)->create();
        Ticket::factory(10)->create();
        Product::factory(10)->create();
    }
}
