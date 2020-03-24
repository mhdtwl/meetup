<?php

namespace App\Http\Controllers;

use App\Group;

class GroupController extends Controller
{

    public function index()
    {
        $groups =  Group::paginate(10);
        return view('groups.index', ['groups' => $groups,  'colors' => $this::GUI_COLORS]);
    }
}
