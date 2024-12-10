<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Exception;
use Illuminate\Http\Request;
use TypeError;

class User extends Controller
{

    //[GET]
    //Gets selected user.
    public function retrieve(Request $request, string $id){
        try {

            if (!is_numeric($id)) {
                throw new TypeError();
            }

            $user = ModelsUser::find($id);

            

            return response()->json(
                $user,
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



    //[GET]
    //Gets all users.
    public function retrieveAll(Request $request){
        try {

            $users = ModelsUser::all();

            return response()->json(
                $users,
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
