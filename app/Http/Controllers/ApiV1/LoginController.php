<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\ApiV1\ApiController as Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
     public function login(Request $request)
     {
         $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
         ]);

         if( !Auth::attempt($login)){
             return response()->json(['message' => 'Invalid username/password'], 401);
             //return response(['message' => 'Invalid...']);
         }

         $accessToken = Auth::user()->createToken('authToken')->accessToken;

         return response(['user' => Auth::user(), 'access-token' => $accessToken ]);
     }

    /**
     * @param Request $request
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
     public function userAll(Request $request){
         return User::all();
         //return response()->json( , 200);
     }

     public function users()
     {
         return User::all();
     }
}
