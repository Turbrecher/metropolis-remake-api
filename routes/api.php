<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Movie;
use App\Http\Controllers\Product;
use App\Http\Controllers\Room;
use App\Http\Controllers\MovieSession;
use App\Http\Controllers\Seat;
use App\Http\Controllers\Ticket;
use App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Movies.
Route::get('/movies', [Movie::class, 'retrieveAll'])->name('retrieveAllMovies');
Route::get('/movies/{id}', [Movie::class, 'retrieve'])->name('retrieveMovie');

//Products.
Route::get('/products', [Product::class, 'retrieveAll'])->name('retrieveAllProducts');
Route::get('/products/{id}', [Product::class, 'retrieve'])->name('retrieveProduct');

//Rooms.
Route::get('/rooms', [Room::class, 'retrieveAll'])->name('retrieveAllRooms');
Route::get('/rooms/{id}', [Room::class, 'retrieve'])->name('retrieveRoom');

//Movie Session.
Route::get('/moviesessions', [MovieSession::class, 'retrieveAll'])->name('retrieveAllMovieSessions');
Route::get('/moviesessions/{id}', [MovieSession::class, 'retrieve'])->name('retrieveMovieSession');

//Seats.
Route::get('/seats', [Seat::class, 'retrieveAll'])->name('retrieveAllSeats');
Route::get('/seats/{id}', [Seat::class, 'retrieve'])->name('retrieveSeat');

//Tickets.
Route::get('/tickets', [Ticket::class, 'retrieveAll'])->name('retrieveAllTickets');
Route::get('/tickets/{id}', [Ticket::class, 'retrieve'])->name('retrieveTicket');

//Authentication.
Route::post('/register', [Auth::class, 'register'])->name('register');
Route::post('/login', [Auth::class, 'login'])->name('login');
Route::post('/logout', [Auth::class, 'logout'])->name('logout')->middleware('auth:sanctum');
Route::get('/profile', [Auth::class, 'profile'])->name('profile')->middleware('auth:sanctum');
Route::get('/role', [Auth::class, 'getRole'])->name('role')->middleware('auth:sanctum');
