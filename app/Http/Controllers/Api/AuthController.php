<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //validation
        $errors = Validator::make($request->all(), [
            "name" => "required|string|max:100",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|confirmed|min:6"
        ]);
        //errors
        if ($errors->fails()) {
            return response()->json([
                "error" => $errors->errors()
            ], 301);
        }
        //hashing password
        $hash_password = bcrypt($request->password);
        //accesstoken
        $access_token = Str::random(64);
        //create user
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $hash_password,
            "access_token" => $access_token,
        ]);



        //redirect
        return response()->json([
            "msg" => "User Registered Successfully",
            "access_tok" => $access_token
        ], 201);
    }
    public function login(Request $request)
    {
        //validation
        $errors = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|string|min:6"
        ]);
        //errors
        if ($errors->fails()) {
            return response()->json([
                "error" => $errors->errors()
            ], 301);
        }
        //check password
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $valid = Hash::check($request->password, $user->password);
            if ($valid) {
                $access_token = Str::random(64);
                $user->update([
                    "access_token" => $access_token
                ]);
            } else {
                return response()->json([
                    "msg" => "password or email doesn't match"
                ], 301);
            }
        }
        //success
        return response()->json([
            "msg" => "User Loggedin Successfully",
            "access_tok" => $user->access_token
        ], 200);
    }
    public function logout(Request $request)
    {
        $access_token = $request->header("access_token");
        if ($access_token != null) {
            $user = User::where("access_token", $access_token)->first();
            if ($user) {
                $user->update([
                    "access_token" => ''
                ]);
            } else {
                return response()->json([
                    "msg" => "no data founded "
                ], 404);
            }
        } else {
            return response()->json([
                "msg" => "access token not valid"
            ], 403);
        }

        return response()->json([
            "msg" => "User Loggedout successfully"
        ], 202);
    }
}
