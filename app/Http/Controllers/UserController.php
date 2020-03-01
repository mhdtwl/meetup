<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  User::paginate(10);
        return view('users.index', ['users' => $users]);
    }

    public function getFirst10Users()
    {
        //$users =  User::orderBy('created_at')->//(10);
        //return view('users.index', ['users' => $users]);
    }
}
