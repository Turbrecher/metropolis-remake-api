<?php

namespace App\Http\Controllers;

use App\Models\Ticket as TicketModel;
use Exception;
use Illuminate\Http\Request;
use TypeError;

class Ticket extends Controller
{
    //[GET]
    //Gets all tickets.
    public function retrieveAll(Request $request)
    {
        try {
            $tickets = TicketModel::all();

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
                "An unexpected error ocurred",
                400
            );
        }
    }
}
