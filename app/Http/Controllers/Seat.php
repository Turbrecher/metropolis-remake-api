<?php

namespace App\Http\Controllers;

use App\Models\Seat as SeatModel;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TypeError;

class Seat extends Controller
{
    //[GET]
    //Gets all seats.
    public function retrieveAll(Request $request)
    {
        try {
            $seats = SeatModel::all();

            if($request->input('room')){
                $seats = SeatModel::where('room_id', $request->input('room'))->get();
            }

            foreach ($seats as $seat) {
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

            $seat = SeatModel::find($id);
            $seat->room;

            return response()->json(
                $seat,
                200
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



    //[PUT]
    //Edits an existing seat
    public function edit(Request $request, string $id)
    {


        try {
            $validated = $request->validate([
                "type" => ["required"],
                "row" => ["required"],
                "col" => ["required"],
                "room_id" => ["required"],

            ]);

            $seat = SeatModel::find($id);
            $seat->type = $request->input('type');
            $seat->row = $request->input('row');
            $seat->col = $request->input('col');
            $seat->room_id = $request->input('room_id');

            $seat->save();

            return response()->json(
                [
                    "message" => "The seat has been edited",
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



    //[DELETE]
    //Deletes an existing seat.
    public function delete(Request $request, string $id)
    {

        try {

            $seat = SeatModel::find($id);

            if ($seat == null) {
                throw new NotFoundHttpException("The seat you're trying to delete doesn't exist");
            }

            $seat->delete();



            return response()->json(
                [
                    "seat" => $seat,
                    "message" => "seat succesfully deleted"
                ],
                200
            );
        } catch (NotFoundHttpException $exception) {
            return response()->json(
                $exception->getMessage(),
                404
            );
        } catch (Exception $exception) {
            return response()->json(
                $exception->getMessage(),
                400
            );
        }
    }


}
