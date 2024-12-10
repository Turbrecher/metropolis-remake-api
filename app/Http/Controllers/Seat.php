<?php

namespace App\Http\Controllers;

use App\Models\Seat as SeatModel;
use Exception;
use Illuminate\Http\Request;
use TypeError;

class Seat extends Controller
{
    //[GET]
    //Gets all seats.
    public function retrieveAll(Request $request)
    {
        try {
            $seats = SeatModel::all();

            foreach($seats as $seat){
                $seat->room;
            }

            return response()->json(
                $seats,
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
    //Gets selected seat.
    public function retrieve(Request $request, string $id)
    {
        try {

            if (!is_numeric($id)) {
                throw new TypeError();
            }

            $seat = SeatModel::find($id);
            $seat->room;

            return response()->json(
                $seat,
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
    //Creates a new seat
    public function create(Request $request)
    {


        try {
            $validated = $request->validate([
                "type" => ["required"],
                "row" => ["required"],
                "col" => ["required"],
                "room_id" => ["required"],

            ]);

            $seat = new SeatModel();
            $seat->type = $request->input('type');
            $seat->row = $request->input('row');
            $seat->col = $request->input('col');
            $seat->room_id = $request->input('room_id');

            $seat->save();

            return response()->json(
                [
                    "message" => "A seat has been created",
                    "seat" => $seat
                ],
                200
            );
        } catch (Exception $exception) {

            return response()->json(
                $exception,
                400
            );
        }
    }


}
