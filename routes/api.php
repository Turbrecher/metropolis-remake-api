<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Movie;
use App\Http\Controllers\Product;
use App\Http\Controllers\Room;
use App\Http\Controllers\MovieSession;
use App\Http\Controllers\Seat;
use App\Http\Controllers\Ticket;
use App\Http\Controllers\User;
use App\Http\Middleware\RequireAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Movies.
Route::get('/movies', [Movie::class, 'retrieveAll'])->name('retrieveAllMovies');
Route::post('/movies', [Movie::class, 'create'])->name('createMovie')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::get('/movies/{id}', [Movie::class, 'retrieve'])->name('retrieveMovie');

//Products.
Route::get('/products', [Product::class, 'retrieveAll'])->name('retrieveAllProducts');
Route::post('/products', [Product::class, 'create'])->name('createProduct')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::get('/products/{id}', [Product::class, 'retrieve'])->name('retrieveProduct');

//Rooms.
Route::get('/rooms', [Room::class, 'retrieveAll'])->name('retrieveAllRooms');
Route::post('/rooms', [Room::class, 'create'])->name('createRoom')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::get('/rooms/{id}', [Room::class, 'retrieve'])->name('retrieveRoom');

//Movie Session.
Route::get('/moviesessions', [MovieSession::class, 'retrieveAll'])->name('retrieveAllMovieSessions');
Route::post('/moviesessions', [MovieSession::class, 'create'])->name('createMovieSession')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::get('/moviesessions/{id}', [MovieSession::class, 'retrieve'])->name('retrieveMovieSession');

//Seats.
Route::get('/seats', [Seat::class, 'retrieveAll'])->name('retrieveAllSeats');
Route::post('/seats', [Seat::class, 'create'])->name('createSeat')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::get('/seats/{id}', [Seat::class, 'retrieve'])->name('retrieveSeat');

//Tickets.
Route::get('/tickets', [Ticket::class, 'retrieveAll'])->name('retrieveAllTickets');
Route::post('/tickets', [Ticket::class, 'create'])->name('createTicket')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::get('/tickets/{id}', [Ticket::class, 'retrieve'])->name('retrieveTicket');

//Authentication.
Route::post('/register', [Auth::class, 'register'])->name('register');
Route::post('/login', [Auth::class, 'login'])->name('login');
Route::post('/logout', [Auth::class, 'logout'])->name('logout')->middleware('auth:sanctum');
Route::get('/profile', [Auth::class, 'profile'])->name('profile')->middleware('auth:sanctum');
Route::get('/role', [Auth::class, 'getRole'])->name('role')->middleware('auth:sanctum');

//Users
Route::get('/users', [User::class, 'retrieveAll'])->name('retrieveAllUsers')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::get('/users/{id}', [User::class, 'retrieve'])->name('retrieveUser')->middleware('auth:sanctum')->middleware(RequireAdmin::class);