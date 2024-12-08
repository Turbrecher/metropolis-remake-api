<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieSession extends Model
{
    //
    use HasFactory;


    protected $fillable = [
        "movie" => "integer",
        "time" => "string",
        'room_id' => "integer"
    ];


    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
