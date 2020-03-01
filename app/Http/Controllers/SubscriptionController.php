<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\SubscriptionTrait;

class SubscriptionController extends Controller
{
    use  SubscriptionTrait;
    /**
     * Display a listing of the resource. // my connections
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->myGroups();//view('subscriptions.groups', $this->getUserConnections());
    }

    ///--------------------------------------Views -----------------
    public function myGroups()
    {

        return view('subscriptions.user.myGroups', ["groups" => $this->getUserGroupConnections(), 'colors' => $this::GUI_COLORS ]);
    }

    public function myPeople()
    {
        return view('subscriptions.user.myUsers', ["users" => $this->getUserPeopleConnections()]);
    }

    public function myInvites()
    {
        return view('subscriptions.user.myInvites', ["subscriptions" => $this->getUserPendingInvitations()]);
    }

    /**
     * @param $groupId
     * @param $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invite($groupId, $userId)
    {
        return view('subscriptions.invite', $this->retrieveUserToInviteByGroupId($groupId, $userId));
    }


    /**
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        //$responseMessage =
        $this->createSubscription($request->groupId, $request->userId) ?  "Sent!, Thanks" : " Something went wrong!";
        return $this->myInvites();// $responseMessage;
    }

    /**
     * @param $groupId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($groupId)// showMyUsersByGroup
    {
        return view('subscriptions.users',  $this->showUsersToConnectByGroupId($groupId));
    }

}
