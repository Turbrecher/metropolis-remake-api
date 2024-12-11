<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    use HasFactory;


    protected $fillable = [
        "title" => "string",
        "synopsis" => "string",
        "actors" => "string",
        "directors" => "string",
        "duration" => "int",
        "releaseDate" => "string",
        "genres" => "string",
        "pegi" => "string",
        "portrait" => "string",
        "trailer" => "string"
    ];

    public function movieSessions()
    {
        return $this->hasMany(MovieSession::class);
    }
}
