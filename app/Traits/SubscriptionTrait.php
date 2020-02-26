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
        $id = Auth::id();
        $groupConnected = Subscription::connectedGroups($id)->paginate(Subscription::PAGINATION_OFFSET);
        $usersConnected = Subscription::connectedUsers($id)->paginate(Subscription::PAGINATION_OFFSET);
        return ['groups' => $groupConnected, 'users' => $usersConnected];
    }

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
        $subscription = new Subscription($groupId, $userId, Auth::id());
        return $subscription->save();
    }


}
