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
        "user" => "integer",
        "date" => "string",

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function session()
    {
        return $this->belongsTo(MovieSession::class);
    }
}
