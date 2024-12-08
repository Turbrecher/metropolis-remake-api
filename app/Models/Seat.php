<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    //
    use HasFactory;


    protected $fillable = [
        "type" => "string",
        "row" => "integer",
        "col" => "integer",
        'room_id'=>'integer'

    ];


    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
