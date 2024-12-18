<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelPdf\Facades\Pdf;

use function Spatie\LaravelPdf\Support\pdf;

class Images extends Controller
{
    //
    public function retrievePortrait(Request $request, string $portraitName)
    {

        try {

            return response()->file(public_path() . '/storage/movies/' . $portraitName);
        } catch (Exception $exception) {
            return response()->json([
                $exception->getMessage()
            ], 400);
        }
    }


    public function retrieveProductImage(Request $request, string $productImageName)
    {

        try {

            return response()->file(public_path() . '/storage/products/' . $productImageName);
        } catch (Exception $exception) {
            return response()->json([
                $exception->getMessage()
            ], 400);
        }
    }

    public function retrieveUserImage(Request $request, string $userImageName)
    {

        try {

            return response()->file(public_path() . '/storage/users/' . $userImageName);
        } catch (Exception $exception) {
            return response()->json([
                $exception->getMessage()
            ], 400);
        }
    }


    public function retrieveTicket(Request $request, string $ticketId)
    {
        try {

            $ticket = Ticket::find($ticketId);
            $ticket->user;
            $ticket->seat;
            $ticket->movieSession;
            $ticket->movieSession->movie;

            /*if ($ticket->user->id != $request->user->id()) {
                return response()->json("Forbidden, this ticket isn't yours", 401);
            }*/

            return pdf()
                ->view('Ticket', [
                    "movieTitle" => $ticket->movieSession->movie->title,
                    "time" => $ticket->movieSession->time,
                    "date" => $ticket->date,
                    "row" => $ticket->seat->row,
                    "col" => $ticket->seat->col,
                    "moviePortrait" => $ticket->movieSession->movie->portrait
                ])
                ->format('a4')
                ->name('ticket.pdf');
        } catch (Exception $exception) {
            return response()->json([
                $exception->getMessage()
            ], 400);
        }
    }
}
