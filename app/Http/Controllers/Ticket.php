<?php

namespace App\Http\Controllers;

use App\Models\Ticket as TicketModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TypeError;

class Ticket extends Controller
{
    //[GET]
    //Gets all tickets.
    public function retrieveAll(Request $request)
    {
        try {
            $tickets = TicketModel::all();


            foreach ($tickets as $ticket) {
                $ticket->movieSession;
                $ticket->user;
                $ticket->seat;
                $ticket->seat->room;
                $ticket->movieSession->movie;
            }

            return response()->json(
                $tickets,
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
    //Gets selected ticket.
    public function retrieve(Request $request, string $id)
    {
        try {

            if (!is_numeric($id)) {
                throw new TypeError();
            }

            $ticket = TicketModel::find($id);
            $ticket->movieSession;
            $ticket->user;
            $ticket->seat;
            $ticket->seat->room;
            $ticket->movieSession->room;
            $ticket->movieSession->movie;

            return response()->json(
                $ticket,
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
    //Creates a new ticket
    public function create(Request $request)
    {


        try {
            $validated = $request->validate([
                "movie_session_id" => ["required"],
                "seat_id" => ["required"],
                "user_id" => ["required"],
                "date" => ["required"],

            ]);

            $ticket = new TicketModel();
            $ticket->movie_session_id = $request->input('movie_session_id');
            $ticket->seat_id = $request->input('seat_id');
            $ticket->user_id = $request->input('user_id');
            $ticket->date = $request->input('date');


            $ticket->save();

            return response()->json(
                [
                    "message" => "A ticket has been created",
                    "ticket" => $ticket
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
    //Edits an existing ticket
    public function edit(Request $request, string $id)
    {


        try {


            $validated = $request->validate([
                "movie_session_id" => ["required"],
                "seat_id" => ["required"],
                "user_id" => ["required"],
                "date" => ["required"],

            ]);

            $ticket = TicketModel::find($id);
            $ticket->movie_session_id = $request->input('movie_session_id');
            $ticket->seat_id = $request->input('seat_id');
            $ticket->user_id = $request->input('user_id');
            $ticket->date = $request->input('date');


            $ticket->save();

            return response()->json(
                [
                    "message" => "The ticket has been edited",
                    "ticket" => $ticket
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
    //Deletes an existing ticket.
    public function delete(Request $request, string $id)
    {

        try {

            $ticket = TicketModel::find($id);

            if ($ticket == null) {
                throw new NotFoundHttpException("The ticket you're trying to delete doesn't exist");
            }

            $ticket->delete();



            return response()->json(
                [
                    "ticket" => $ticket,
                    "message" => "ticket succesfully deleted"
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
