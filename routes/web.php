<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        "welcome"=>"Welcome to metropolis-remake API!",
        "description"=>"Here, you'll be able to get all data from movies, sessions, products unlimited. Moreso, you can also check your own profile data, buy tickets and more, but it requires authentication!",
        "urls"=>[
            "'/movies' [GET]"=>"You can check all movies' data",
            "'/movies/:id' [GET]"=>"You can check a movie's data",
            "'/products' [GET]"=>"You can check all products' data",
            "'/products/':id [GET]"=>"You can check a product's data",
            "'/sessions' [GET]"=>"You can check all sessions' data",
            "'/sessions/:id' [GET]"=>"You can check a session's data",
            "'/rooms' [GET]"=>"You can check all rooms' data",
            "'/rooms/:id' [GET]"=>"You can check a room's data",
            "'/register' [POST]"=>"You can register your own account",
            "'/login' [POST]"=>"You can log in to your own account",

        ]
    ]);
});
