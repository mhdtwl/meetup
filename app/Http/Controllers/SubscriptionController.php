<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteUserToGroup;
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

        return $this->myGroups();
    }

    ///--------------------------------------Views -----------------
    public function myGroups()
    {
        return view('subscriptions.user.myGroups',
            ["groups" => $this->getUserGroupConnections(), 'colors' => $this::GUI_COLORS]);
    }

    public function myPeople()
    {
        return view('subscriptions.user.myUsers', ["users" => $this->getUserPeopleConnections()]);
    }

    public function myInvites()
    {
        return view('subscriptions.user.myInvites', ["subscriptions" => $this->getUserPendingInvitations()]);
    }

    ///--------------------------- Actions -----------------

    /**
     * Show user per group to invite
     * @param $groupId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($groupId)
    {
        return view('subscriptions.users', $this->showUsersToConnectByGroupId($groupId));
    }

    /**
     * Show invitation form
     * @param $groupId
     * @param $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invite($groupId, $userId)
    {
        return view('subscriptions.invite', $this->retrieveUserToInviteByGroupId($groupId, $userId));
    }

    /**
     * TODO add thanks message for inviting /"Sent!, Thanks" : " Something went wrong!";
     * Store invitation
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(InviteUserToGroup $request)
    {
        $message = $this->createSubscription($request);
        return redirect()->action('SubscriptionController@myInvites')->with($message);
    }
}
