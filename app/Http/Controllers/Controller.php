<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controller
{
    //[GET]
    //Welcome page in json.
    public function welcome(Request $request)
    {
        return response()->json([
            "welcome" => "Welcome to metropolis-remake API!",
            "description" => "Here, you'll be able to get all data from movies, sessions, products unlimited. Moreso, you can also check your own profile data, buy tickets and more, but it requires authentication!",
            "public_urls" => [
                "'/movies' [GET]" => "You can check all movies' data",
                "'/movies/:id' [GET]" => "You can check a movie's data",
                "'/products' [GET]" => "You can check all products' data",
                "'/products/':id [GET]" => "You can check a product's data",
                "'/moviesessions' [GET]" => "You can check all movie sessions' data",
                "'/moviesessions/:id' [GET]" => "You can check a movie session's data",
                "'/rooms' [GET]" => "You can check all rooms' data",
                "'/rooms/:id' [GET]" => "You can check a room's data",
                "'/register' [POST]" => "You can register your own account",
                "'/login' [POST]" => "You can log in to your own account",

            ],
            "authenticated_urls" => [
                "'/movies' [POST]" => "You can create a new movie",
                "'/movies/:id' [PUT]" => "You can edit a movie's data",
                "'/products' [POST]" => "You can check all products' data",
                "'/products/':id [PUT]" => "You can edit a product's data",
                "'/moviesessions' [POST]" => "You can create a new movie session' data",
                "'/moviesessions/:id' [PUT]" => "You can edit a movie session's data",
                "'/rooms' [POST]" => "You can create a new room",
                "'/rooms/:id' [PUT]" => "You can edit a room's data",
                "'/profile' [GET]" => "You can check your account's data",
                "'/profile' [POST]" => "You can change your account's data",

            ]
        ]);
    }
}
