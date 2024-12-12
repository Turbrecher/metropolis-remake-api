<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Images;
use App\Http\Controllers\Movie;
use App\Http\Controllers\Product;
use App\Http\Controllers\Room;
use App\Http\Controllers\MovieSession;
use App\Http\Controllers\Seat;
use App\Http\Controllers\Ticket;
use App\Http\Controllers\User;
use App\Http\Middleware\ParamIsNumeric;
use App\Http\Middleware\RequireAdmin;
use Illuminate\Support\Facades\Route;


//Movies.
Route::get('/movies', [Movie::class, 'retrieveAll'])->name('retrieveAllMovies');
Route::post('/movies', [Movie::class, 'create'])->name('createMovie')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::get('/movies/{id}', [Movie::class, 'retrieve'])->name('retrieveMovie')->middleware(ParamIsNumeric::class);
Route::put('/movies/{id}', [Movie::class, 'edit'])->name('editMovie')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);
Route::delete('/movies/{id}', [Movie::class, 'delete'])->name('deleteMovie')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);

//Products.
Route::get('/products', [Product::class, 'retrieveAll'])->name('retrieveAllProducts');
Route::post('/products', [Product::class, 'create'])->name('createProduct')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::get('/products/{id}', [Product::class, 'retrieve'])->name('retrieveProduct')->middleware(ParamIsNumeric::class);
Route::put('/products/{id}', [Product::class, 'edit'])->name('editProduct')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);
Route::delete('/products/{id}', [Product::class, 'delete'])->name('deleteProduct')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);

//Rooms.
Route::get('/rooms', [Room::class, 'retrieveAll'])->name('retrieveAllRooms');
Route::post('/rooms', [Room::class, 'create'])->name('createRoom')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::get('/rooms/{id}', [Room::class, 'retrieve'])->name('retrieveRoom')->middleware(ParamIsNumeric::class);
Route::put('/rooms/{id}', [Room::class, 'edit'])->name('editRoom')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);
Route::delete('/rooms/{id}', [Room::class, 'delete'])->name('deleteRoom')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);

//Movie Session.
Route::get('/moviesessions', [MovieSession::class, 'retrieveAll'])->name('retrieveAllMovieSessions');
Route::post('/moviesessions', [MovieSession::class, 'create'])->name('createMovieSession')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::get('/moviesessions/{id}', [MovieSession::class, 'retrieve'])->name('retrieveMovieSession')->middleware(ParamIsNumeric::class);
Route::put('/moviesessions/{id}', [MovieSession::class, 'edit'])->name('editMovieSession')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);
Route::delete('/moviesessions/{id}', [MovieSession::class, 'delete'])->name('deleteMovieSession')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);

//Seats.
Route::get('/seats', [Seat::class, 'retrieveAll'])->name('retrieveAllSeats');
Route::post('/seats', [Seat::class, 'create'])->name('createSeat')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::get('/seats/{id}', [Seat::class, 'retrieve'])->name('retrieveSeat')->middleware(ParamIsNumeric::class);
Route::put('/seats/{id}', [Seat::class, 'edit'])->name('editSeat')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);
Route::delete('/seats/{id}', [Seat::class, 'delete'])->name('deleteSeat')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);

//Tickets.
Route::get('/tickets', [Ticket::class, 'retrieveAll'])->name('retrieveAllTickets')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::post('/tickets', [Ticket::class, 'create'])->name('createTicket')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::get('/tickets/{id}', [Ticket::class, 'retrieve'])->name('retrieveTicket')->middleware('auth:sanctum')->middleware(ParamIsNumeric::class);
Route::put('/tickets/{id}', [Ticket::class, 'edit'])->name('editTicket')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);
Route::delete('/tickets/{id}', [Ticket::class, 'delete'])->name('deleteTicket')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);

//Authentication.
Route::post('/register', [Auth::class, 'register'])->name('register');
Route::post('/login', [Auth::class, 'login'])->name('login');
Route::post('/logout', [Auth::class, 'logout'])->name('logout')->middleware('auth:sanctum');
Route::get('/profile', [Auth::class, 'profile'])->name('profile')->middleware('auth:sanctum');
Route::put('/profile', [Auth::class, 'editProfile'])->name('editProfile')->middleware('auth:sanctum');
Route::get('/role', [Auth::class, 'getRole'])->name('role')->middleware('auth:sanctum');

//Users
Route::get('/users', [User::class, 'retrieveAll'])->name('retrieveAllUsers')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::post('/users', [User::class, 'create'])->name('retrieveAllUsers')->middleware('auth:sanctum')->middleware(RequireAdmin::class);
Route::get('/users/{id}', [User::class, 'retrieve'])->name('retrieveUser')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);
Route::put('/users/{id}', [User::class, 'edit'])->name('retrieveUser')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);
Route::delete('/users/{id}', [User::class, 'delete'])->name('deleteUser')->middleware('auth:sanctum')->middleware(RequireAdmin::class)->middleware(ParamIsNumeric::class);


//Images
Route::get("/portraits/{portraitName}", [Images::class, 'retrievePortrait'])->name('retrievePortrait');
Route::get("/productimages/{productImageName}", [Images::class, 'retrieveProductImage'])->name('retrieveProductImage');
Route::get("/userimages/{userImageName}", [Images::class, 'retrieveUserImage'])->name('retrieveUserImage');