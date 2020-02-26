<?php

namespace App\Http\Controllers;

use App\User;
use App\Group;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        return view('subscriptions.groups', $this->getUserConnections());
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
        $responseMessage = $this->createSubscription($request->groupId, $request->userId) ?  "Sent!, Thanks" : " Something went wrong!";
        return $responseMessage;
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
