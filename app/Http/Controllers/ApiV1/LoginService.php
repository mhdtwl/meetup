<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\ApiV1\ApiController as Controller;
use App\Traits\SearchableTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LoginService extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
     public function login(Request $request)
     {
         $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
         ]);

         if( !Auth::attempt($login)){
             return response()->json(['message' => 'Invalid username/password'], 401);
         }

         $accessToken = Auth::user()->createToken('authToken')->accessToken;

         return response(['user' => Auth::user(), 'access-token' => $accessToken ]);
     }
}
