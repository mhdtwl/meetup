<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups =  Group::paginate(10);
        return view('groups.index', ['groups' => $groups,  'colors' => $this::GUI_COLORS]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Group $group)
    {
        //
    }


    public function edit(Group $group)
    {
        //
    }

    public function update(Request $request, Group $group)
    {
        //
    }

    public function destroy(Group $group)
    {
        //
    }
}
