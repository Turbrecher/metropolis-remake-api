<?php

namespace App\Http\Controllers;

use App\Models\Movie as MovieModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use TypeError;

class Movie extends Controller
{

    //[GET]
    //Gets all movies.
    public function retrieveAll(Request $request)
    {
        try {
            $movies = MovieModel::all();

            foreach ($movies as $movie) {
                $movie->movieSessions;

                foreach ($movie->movieSessions as $session) {
                    $session->movie;
                    $session->room;
                }
            }

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
            $movie->movieSessions;

            foreach ($movie->movieSessions as $session) {
                $session->movie;
                $session->room;
            }



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


    //[POST]
    //Creates a new movie
    public function create(Request $request)
    {


        try {
            $validated = $request->validate([
                "title" => ["required"],
                "synopsis" => ["required"],
                "actors" => ["required"],
                "directors" => ["required"],
                "duration" => ["required"],
                "releaseDate" => ["required"],
                "genres" => ["required"],
                "pegi" => ["required"],
                "portrait" => ["required"],

            ]);

            $movie = new MovieModel();
            $movie->title = $request->input('title');
            $movie->synopsis = $request->input('synopsis');
            $movie->actors = $request->input('actors');
            $movie->directors = $request->input('directors');
            $movie->duration = $request->input('duration');
            $movie->releaseDate = $request->input('releaseDate');
            $movie->genres = $request->input('genres');
            $movie->pegi = $request->input('pegi');


            if ($request->file('portrait')) {
                $portrait = $request->file('portrait');
                $name = $request->file('portrait')->hashName();
                Storage::disk('public')->put('movies/' . $name, file_get_contents($portrait));
                $movie->portrait = $name;
            }

            $movie->save();

            return response()->json(
                [
                    "message" => "A movie has been created",
                    "movie" => $movie
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
