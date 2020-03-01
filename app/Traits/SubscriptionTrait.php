<?php

namespace App\Traits;

use App\Group;
use App\Subscription;
use App\User;
use Illuminate\Support\Facades\Auth;

trait SubscriptionTrait
{

    /**
     * Returns a listing of the resources. | (groups & users) connections
     * @return array
     */
    public function getUserConnections(): array
    {
        $groupConnected = $this->getUserGroupConnections();
        $usersConnected = $this->getUserPeopleConnections();
        return ['groups' => $groupConnected, 'users' => $usersConnected];
    }

    //---------------------------------------------------

    public function getUserGroupConnections()
    {
        $id = Auth::id();
        return Subscription::connectedGroups($id)->simplePaginate(Subscription::PAGINATION_OFFSET);
    }

    public function getUserPeopleConnections()
    {
        $id = Auth::id();
        return Subscription::myCurrentUsers($id)->paginate(Subscription::PAGINATION_OFFSET);
    }

    public function getUserPendingInvitations()
    {
        $id = Auth::id();
        return Subscription::myInvitations($id)->paginate(Subscription::PAGINATION_OFFSET);
    }
    //---------------------------------------------------




    /**
     * Returns a User & a Group to
     * @param $groupId
     * @param $userId
     * @return array
     */
    public function retrieveUserToInviteByGroupId($groupId, $userId): array
    {
        $group = Group::findorFail($groupId);
        $user = User::findorFail($userId);
        return ['group' => $group, 'user' => $user];
    }

    /**
     * Return list of users suggested to be invited to a group.
     * @param $groupId
     * @return array
     */
    public function showUsersToConnectByGroupId($groupId): array // showMyUsersByGroup
    {
        $id = Auth::id();
        $group = Group::findorFail($groupId);
        $suggestedUsers = Subscription::unconnectedUsers($id)->paginate(Subscription::PAGINATION_OFFSET);
        return ['users' => $suggestedUsers, 'group' => $group];
    }

    /**
     * Create invitation by groupId & userId into db.
     * @param $groupId
     * @param $userId
     * @return bool
     */
    public function createSubscription($groupId, $userId): bool
    {
        $subscription = new Subscription();
        $subscription->assignAttributes($groupId, $userId, Auth::id());
        return $subscription->save();
    }


}
