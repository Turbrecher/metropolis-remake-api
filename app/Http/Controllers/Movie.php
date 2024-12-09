<?php

namespace App\Http\Controllers;

use App\Models\Movie as MovieModel;
use Exception;
use Illuminate\Http\Request;
use TypeError;

class Movie extends Controller
{

    //[GET]
    //Gets all movies.
    public function retrieveAll(Request $request)
    {
        try {
            $movies = MovieModel::all();

            return response()->json(
                $movies,
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
    //Gets selected movie.
    public function retrieve(Request $request, string $id)
    {

        try {

            if (!is_numeric($id)) {
                throw new TypeError();
            }


            $movie = MovieModel::find($id);

            return response()->json(
                $movie,
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
