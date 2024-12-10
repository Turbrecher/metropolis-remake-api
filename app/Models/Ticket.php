<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //

    use HasFactory;

    protected $fillable = [
        "movie_session_id" => "integer",
        "user_id" => "integer",
        "date" => "string",
        "seat_id" => "integer",

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movieSession()
    {
        return $this->belongsTo(MovieSession::class);
    }

    public function seat(){
        return $this->belongsTo(Seat::class);
    }
}
