<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
}
