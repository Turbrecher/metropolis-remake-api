<?php

namespace App\Http\Controllers;

use App\Models\MovieSession as MovieSessionModel;
use Exception;
use Illuminate\Http\Request;
use TypeError;

class MovieSession extends Controller
{
    //[GET]
    //Gets all movie sessions.
    public function retrieveAll(Request $request)
    {
        try {
            $movieSessions = MovieSessionModel::all();

            foreach ($movieSessions as $movieSession) {
                $movieSession->room;
                $movieSession->movie;
            }

            return response()->json(
                $movieSessions,
                200
            );
        } catch (TypeError $typeError) {

            return response()->json(
                "You have to filter by id, which is a number",
                400
            );
        } catch (Exception $exception) {

            return response()->json(
                $exception,
                400
            );
        }
    }


    //[GET]
    //Gets selected movie session.
    public function retrieve(Request $request, string $id)
    {
        try {

            if (!is_numeric($id)) {
                throw new TypeError();
            }


            $movieSession = MovieSessionModel::find($id);
            $movieSession->room;
            $movieSession->movie;

            return response()->json(
                $movieSession,
                200
            );
        } catch (TypeError $typeError) {

            return response()->json(
                "You have to filter by id, which has to be a number",
                400
            );
        } catch (Exception $exception) {

            return response()->json(

                $exception,
                400
            );
        }
    }


    //[POST]
    //Creates a new movie session
    public function create(Request $request)
    {


        try {
            $validated = $request->validate([
                "time" => ["required"],
                "room_id" => ["required"],
                "movie_id" => ["required"],

            ]);

            $movieSession = new MovieSessionModel();
            $movieSession->time = $request->input('time');
            $movieSession->room_id = $request->input('room_id');
            $movieSession->movie_id = $request->input('movie_id');

            $movieSession->save();

            return response()->json(
                [
                    "message" => "A movie session has been created",
                    "movie session" => $movieSession
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
