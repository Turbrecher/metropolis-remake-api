<?php

namespace App\Http\Controllers;

use App\Models\Movie as MovieModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        } catch (Exception $exception) {
            return response()->json(
                $exception,
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
                "trailer" => ["required"],

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
            $movie->trailer = $request->input('trailer');


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
                $exception,
                400
            );
        }
    }




    //[PUT]
    //Edits an existing movie
    public function edit(Request $request, string $id)
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
                "trailer" => ["required"],

            ]);

            $movie = MovieModel::find($id);
            $movie->title = $request->input('title');
            $movie->synopsis = $request->input('synopsis');
            $movie->actors = $request->input('actors');
            $movie->directors = $request->input('directors');
            $movie->duration = $request->input('duration');
            $movie->releaseDate = $request->input('releaseDate');
            $movie->genres = $request->input('genres');
            $movie->pegi = $request->input('pegi');
            $movie->trailer = $request->input('trailer');


            if ($request->file('portrait')) {
                $portrait = $request->file('portrait');
                $name = $request->file('portrait')->hashName();
                Storage::disk('public')->put('movies/' . $name, file_get_contents($portrait));
                $movie->portrait = $name;
            }

            $movie->save();

            return response()->json(
                [
                    "message" => "The movie has been edited",
                    "movie" => $movie
                ],
                200
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
    //Deletes an existing movie.
    public function delete(Request $request, string $id)
    {

        try {

            $movie = MovieModel::find($id);

            if ($movie == null) {
                throw new NotFoundHttpException("The movie you're trying to delete doesn't exist");
            }

            $movie->delete();



            return response()->json(
                [
                    "movie" => $movie,
                    "message" => "Movie succesfully deleted"
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
