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
     * Display a listing of the resource. //
     *
     * @return \Illuminate\Http\Response
     */
//    public function others()
//    {
//        $subscriptionList = Subscription::whereIn('status', Subscription::STATUS_INACTIVE)
//            ->where('invited_by_id', Auth::id())
//            ->simplePaginate(3);
//        return view('subscriptions.index', ['subscriptionList' => $subscriptionList]);
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('subscriptions.users', [ 'users' => $usersConnected, 'group' => $group]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @param $groupId
     * @param $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invite($groupId, $userId)
    {
        $group = Group::findorFail($groupId);
        $user  = User::findorFail($userId);
        return view('subscriptions.invite', [ 'group' => $group, 'user' => $user]);
    }
    //inviteStore store

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $subscription->save();
        return ["Sent!, Thanks"];

    }


    public function show($groupId)// showMyUsersByGroup
    {
        $id = Auth::id();
        $group = Group::where('id', $groupId)->get()->first();
        $usersConnected = Subscription::unconnectedUsers($id)->paginate(Controller::PAGINATION_OFFSET);
        return view('subscriptions.users', [ 'users' => $usersConnected, 'group' => $group]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
//    public function show(Subscription $subscription)
//    {
//        $id = Auth::id();
//        //$groupConnected = Subscription::connectedGroups($id);
//
//        //$usersConnected = Subscription::connectedUsers($id);
//        //'users' => $usersConnected,
////        'users' => $usersConnected] 'authId' => $subscription->id,
//        return view('subscriptions.users', [ 'users' => $usersConnected]);
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
