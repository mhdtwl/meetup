<?php

namespace App\Http\Controllers\ApiV1;

use App\User;
use App\Traits\SearchableTrait;

use Illuminate\Http\{Request, Response, JsonResponse};
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Routing\ResponseFactory;

class LoginRestController extends RestController
{
    /**
     * @param Request $request
     * @return ResponseFactory|JsonResponse|Response
     */
    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($login)) {
            return response()->json(['message' => 'Invalid username/password'], 401);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response(['user' => Auth::user(), 'access-token' => $accessToken]);
    }
}
