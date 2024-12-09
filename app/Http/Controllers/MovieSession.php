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
                "An unexpected error ocurred",
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
                "An unexpected error ocurred",
                400
            );
        }
    }
}
