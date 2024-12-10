<?php

namespace App\Http\Controllers;

use App\Models\Room as RoomModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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




    //[PUT]
    //Edits an existing room
    public function edit(Request $request, string $id)
    {

        if (!is_numeric($id)) {
            throw new TypeError();
        }


        try {
            $validated = $request->validate([
                "name" => ["required"],
                "rows" => ["required"],
                "cols" => ["required"],

            ]);

            $room = RoomModel::find($id);
            $room->name = $request->input('name');
            $room->rows = $request->input('rows');
            $room->cols = $request->input('cols');

            $room->save();

            return response()->json(
                [
                    "message" => "The room has been edited",
                    "room" => $room
                ],
                200
            );
        } catch (TypeError $typeError) {
            return response()->json(
                "You have to filter by id, which has to be a number",
                400
            );
        } catch (ValidationException $exception) {

            return response()->json(
                "Fields received are invalid. (Remember that you have to use a post request with an attribute _method=PUT, otherwise, request will be empty)",
                422
            );
        } catch (Exception $exception) {

            return response()->json(
                $exception,
                400
            );
        }
    }


    //[DELETE]
    //Deletes an existing room.
    public function delete(Request $request, string $id)
    {

        try {

            $room = RoomModel::find($id);

            if ($room == null) {
                throw new NotFoundHttpException("The room you're trying to delete doesn't exist");
            }

            $room->delete();



            return response()->json(
                [
                    "room" => $room,
                    "message" => "room succesfully deleted"
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
