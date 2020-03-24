<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteUserToGroup;
use App\Repositories\SubscriptionRepository;
use App\Traits\SubscriptionTrait;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    use  SubscriptionTrait;

    protected $repository;

    public function __construct()
    {
        $this->repository = new SubscriptionRepository();
    }

    /**
     * Display a listing of the resource. // my connections
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->myGroups();
    }

    ///**********************  Views **********************
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

    /// ****************************** Actions *******************************
    /**
     * Show user per group to invite
     * @param int $groupId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($groupId = 0)
    {
        $validator = Validator::make(["groupId" => $groupId], [
            'groupId' => 'required|numeric|exists:groups,id',
        ]);
        $validator->validated();
        return view('subscriptions.users', $this->showUsersToConnectByGroupId($groupId));
    }

    /**
     * Show invitation form
     * @param int $groupId
     * @param int $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invite($groupId = 0, $userId = 0)
    {
        $validator = Validator::make(["groupId" => $groupId, "userId" => $userId], [
            "InviteUserToGroup"
        ]);
        $validator->validated();
        return view('subscriptions.invite', $this->retrieveUserToInviteByGroupId($groupId, $userId));
    }

    /**
     * TODO add thanks message for inviting on view |"Sent!, Thanks" : " Something went wrong!";
     * Store invitation
     * @param InviteUserToGroup $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(InviteUserToGroup $request)
    {
        $newSubscription = $this->createSubscription($request);
        return redirect()->action('SubscriptionController@myInvites')->with([$newSubscription]);
    }
}
