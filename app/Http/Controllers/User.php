<?php

namespace App\Http\Controllers;

use App\Models\User as UserModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use TypeError;

class User extends Controller
{

    //[GET]
    //Gets selected user.
    public function retrieve(Request $request, string $id)
    {
        try {

            if (!is_numeric($id)) {
                throw new TypeError();
            }

            $user = UserModel::find($id);



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
                $exception,
                400
            );
        }
    }



    //[GET]
    //Gets all users.
    public function retrieveAll(Request $request)
    {
        try {

            $users = UserModel::all();

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
                $exception,
                400
            );
        }
    }



    //[POST]
    //Creates a new user
    public function create(Request $request)
    {
        try {

            $validated = $request->validate([
                "email" => ["required"],
                "password" => ["required"],
                "role" => ["required"]

            ]);

            $user = new UserModel();
            $user->email = strtoupper($request['email']);
            $user->password = Hash::make($request['password']);

            if ($request->input('role') != 'admin') {
                $user->assignRole("user");
            } else {
                $user->assignRole("admin");
            }

            $user->save();

            return response()->json(
                [
                    "user" => $user,
                    "message" => "User succesfully created"
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
    //Edits an existing user
    public function edit(Request $request, string $id)
    {
        try {

            $validated = $request->validate([
                "email" => ["required"],
                "role" => ["required"]

            ]);

            $user = UserModel::find($id);
            $user->email = strtoupper($request['email']);

            if ($request['password']) {
                $user->password = Hash::make($request['password']);
            }


            if ($request->input('role') != 'admin') {
                $user->assignRole("user");
            } else {
                $user->assignRole("admin");
            }

            $user->save();

            return response()->json(
                [
                    "user" => $user,
                    "message" => "User succesfully edited"
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
