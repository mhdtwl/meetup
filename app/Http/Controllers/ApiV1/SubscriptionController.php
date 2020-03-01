<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Http\Requests\InviteUserToGroup;
use App\Traits\SubscriptionTrait;

class SubscriptionController extends Controller
{
    use  SubscriptionTrait;

    public function getMyGroups()
    {
        return $this->getUserGroupConnections();
    }

    public function getMyPeople()
    {
        return $this->getUserPeopleConnections();
    }

    public function getMyInvitations()
    {
        return $this->getUserPendingInvitations();
    }

//    /**
//     * - request to create a relationship with a fellow user in a group
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */

    public function inviteUserToGroup(InviteUserToGroup $request)
    {
        if( $obj = $this->createSubscription($request) ) {
            return response()->json($obj , 201);
        }
    }





}
