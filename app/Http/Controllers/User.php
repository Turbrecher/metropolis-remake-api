<?php

namespace App\Http\Controllers;

use App\Models\User as UserModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
            $user->roles[0];



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
                $exception->getMessage(),
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
                $exception->getMessage(),
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

            if($request->input('name')){
                $user->name = $request->input('name');
            }

            if($request->input('surname')){
                $user->name = $request->input('surname');
            }

            if($request->input('username')){
                $user->name = $request->input('username');
            }

            $user->photo = 'default.png';

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
                $exception->getMessage(),
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

            if ($request->input('name')) {
                $user->name = $request->input('name');
            }

            if ($request->input('surname')) {
                $user->surname = $request->input('surname');
            }

            if ($request->input('username')) {
                $user->username = $request->input('username');
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



    //[DELETE]
    //Deletes an existing user
    public function delete(Request $request, string $id)
    {
        try {
            $user = UserModel::find($id);

            if ($user == null) {
                throw new NotFoundHttpException("The user you're trying to delete doesn't exist");
            }

            $user->delete();

            return response()->json(
                [
                    "user" => $user,
                    "message" => "User succesfully deleted"
                ],
                200
            );
        } catch (NotFoundHttpException $exception) {

            return response()->json(
                $exception->getMessage(),
                400
            );
        } catch (Exception $exception) {

            return response()->json(
                $exception->getMessage(),
                400
            );
        }
    }
}
