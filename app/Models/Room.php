<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    use HasFactory;


    protected $fillable = [
        "name" => "string",
        "rows" => "integer",
        "cols" => "integer",

    ];


    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
