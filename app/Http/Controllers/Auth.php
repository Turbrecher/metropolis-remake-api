<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Exception;
use Illuminate\Support\Facades\Hash;

class Auth extends Controller
{
    //Method that creates a new user on db.
    function register(Request $request)
    {
        try {



            $validated = $request->validate([
                "password" => ["required", "regex:/^[A-Za-z0-9?¿_-]{5,50}|^$/"],
                "email" => ["required"],
            ]);


            $user = new UserModel();
            $user->email = strtoupper($request['email']);
            $user->password = Hash::make($request['password']);
            $user->assignRole("user");

            $user->save();

            return response()->json(
                [
                    "user_id" => $user->id,
                    "message" => "User succesfully created"
                ],
                200
            );
        } catch (Exception $e) {
            return response()->json([
                'error' => $e
            ], 400);
        }
    }



    //Login
    function login(Request $request)
    {
        $user = UserModel::where('email',  strtoupper($request->email))->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(
                [
                    'message' => ['Username or password incorrect']
                ],
                400
            );
        }

        $user->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User logged in successfully',
            'name' => $user->name,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    }

    //Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'User logged out successfully'
            ]
        );
    }


    //Profile
    public function profile(Request $request)
    {

        $user = $request->user();
        $user->tickets;
        foreach ($user->tickets as $ticket) {
            $ticket->movieSession;
            $ticket->movieSession->movie;
            $ticket->seat;
        }

        return response()->json(
            $user,
            200
        );
    }


    public function getRole(Request $request)
    {

        if ($request->user()->hasRole("admin")) {
            return response()->json(
                ["role" => "admin"]
            );
        }

        return response()->json(
            ["role" => "user"]
        );
    }



    //[PUT]
    //Edits your profile
    public function editProfile(Request $request)
    {
        try {


            $user = UserModel::find($request->user()->id);

            if ($request['email']) {
                $user->email = strtoupper($request['email']);
            }

            if ($request['password']) {
                $user->password = Hash::make($request['password']);
            }

            if ($request->input('name')) {
                $user->name = strtoupper($request->input('name'));
            }

            if ($request->input('surname')) {
                $user->surname = strtoupper($request->input('surname'));
            }

            if ($request->input('username')) {
                $user->username = strtoupper($request->input('username'));
            }

            $user->save();

            return response()->json(
                [
                    "user" => $user,
                    "message" => "Profile succesfully edited"
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
