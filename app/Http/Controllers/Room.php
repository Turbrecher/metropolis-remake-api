<?php

namespace App\Http\Controllers;

use App\Models\Room as RoomModel;
use Exception;
use Illuminate\Http\Request;
use Throwable;
use TypeError;

class Room extends Controller
{
    //[GET]
    //Gets all rooms.
    public function retrieveAll(Request $request)
    {
        try {
            $rooms = RoomModel::all();

            return response()->json(
                $rooms,
                200
            );
        } catch (TypeError $typeError) {

            return response()->json(
                "You have to filter by id, which is a number",
                400
            );
        } catch (Exception $exception) {

            return response()->json(
                "An unexpected error ocurred",
                400
            );
        }
    }


    //[GET]
    //Gets selected room.
    public function retrieve(Request $request, string $id)
    {
        try {

            if (!is_numeric($id)) {
                throw new TypeError();
            }

            $room = RoomModel::find($id);

            return response()->json(
                $room,
                200
            );
        } catch (TypeError $typeError) {

            return response()->json(
                "You have to filter by id, which has to be a number",
                400
            );
        } catch (Exception $exception) {

            return response()->json(
                "An unexpected error ocurred",
                400
            );
        }
    }



    //[POST]
    //Creates a new room
    public function create(Request $request)
    {


        try {
            $validated = $request->validate([
                "name" => ["required"],
                "rows" => ["required"],
                "cols" => ["required"],

            ]);

            $room = new RoomModel();
            $room->name = $request->input('name');
            $room->rows = $request->input('rows');
            $room->cols = $request->input('cols');

            $room->save();

            return response()->json(
                [
                    "message" => "A room has been created",
                    "room" => $room
                ],
                200
            );
        } catch (Exception $exception) {

            return response()->json(
                "An unexpected error ocurred",
                400
            );
        }
    }
}
