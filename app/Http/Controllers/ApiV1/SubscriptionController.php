<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * - request to create a relationship with a fellow user in a group
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function inviteUserIntoGroup(Request $request)
    {

    }

    /**
     * - list of a user’s current connections [filters]
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConnections()
    {
        $authUserId = Auth::user()->id();
    }


}
