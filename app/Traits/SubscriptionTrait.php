<?php

namespace App\Traits;

use App\{Subscription, Group, User};
use Illuminate\Pagination\{Paginator, LengthAwarePaginator};
use App\Http\Requests\InviteUserToGroup;
use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Auth;

trait SubscriptionTrait
{
    //***********************************    View    *********************************
    /**
     * @return Paginator
     */
    public function getUserGroupConnections(): Paginator
    {
        $id = Auth::id();
        return $this->repository->connectedGroups($id)->simplePaginate(SubscriptionRepository::PAGINATION_OFFSET);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getUserPeopleConnections(): LengthAwarePaginator
    {
        $id = Auth::id();
        return $this->repository->myCurrentUsers($id)->paginate(SubscriptionRepository::PAGINATION_OFFSET);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getUserPendingInvitations(): LengthAwarePaginator
    {
        $id = Auth::id();
        return $this->repository->myInvitations($id)->paginate(SubscriptionRepository::PAGINATION_OFFSET);
    }

    //***********************************    Action    *********************************

    /**
     * @param int $groupId
     * @param int $userId
     * @return array
     */
    public function retrieveUserToInviteByGroupId($groupId = 0, $userId = 0): array
    {
        $group = Group::findorFail($groupId);
        $user = User::findorFail($userId);
        return ['group' => $group, 'user' => $user];
    }

    /**
     * Return list of users I know, suggested to be invited to a group.
     * @param int $groupId
     * @return array
     */
    public function showUsersToConnectByGroupId($groupId = 0): array
    {
        $id = Auth::id();
        $group = Group::findorFail($groupId);
        $suggestedUsers = $this->repository->unconnectedUsers($id)->paginate(SubscriptionRepository::PAGINATION_OFFSET);
        return ['users' => $suggestedUsers, 'group' => $group];
    }

    /**
     * Create invitation by groupId & userId into db.
     * @param InviteUserToGroup $request
     * @return Subscription
     */
    public function createSubscription(InviteUserToGroup $request): Subscription
    {
        $validated = $request->validated();
        $groupId = $validated['groupId'];
        $userId = $validated['userId'];
        $subscription = new Subscription();
        $subscription->assignAttributes($groupId, $userId, Auth::id());
        $subscription->save();
        return $subscription;
    }
}
