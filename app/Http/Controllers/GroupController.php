<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function index()
    {
        $groups =  Group::paginate(10);
        return view('groups.index', ['groups' => $groups,  'colors' => $this::GUI_COLORS]);
    }
}
