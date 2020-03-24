<?php

namespace App\Repositories;

use App\Group;
use App\Subscription;
use App\User;

/**
 * Class SubscriptionRepository
 * @package App
 */
class SubscriptionRepository
{
    const PAGINATION_OFFSET = 8;

    //********************    User / Group Relation Section *******************

    /**
     * @param int $userId
     * @return mixed
     */
    private function connectedGroupIds($userId = 0)
    {
        return Subscription::whereIn('status', Subscription::STATUS_LIST_CONNECTED)
            ->where('user_id', $userId)
            ->get()->pluck('group_id')->toArray();
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function connectedGroups($userId = 0)
    {
        return Group::whereIn('id', $this->connectedGroupIds($userId));
    }

    /**
     * TODO to use it as  [ RSVP ] somewhere [ not used yet ]
     * The Groups of user can see but not in.
     * @param int $userId
     * @return mixed
     */
    public function unconnectedGroups($userId = 0)
    {
        $getGroupAllStatusIds = Subscription::where('user_id', $userId)
            ->get()->pluck('group_id')->toArray();
        return Group::whereIn('type', Group::VISIBLE_GROUP_TYPES)
            ->whereNotIn('id', $getGroupAllStatusIds)
            ->get();
    }

    //******************    User / User Relation Section ******************

    /**
     * @param int $userId
     * @return mixed
     */
    private function connectedUserIds($userId = 0)
    {
        return Subscription::whereIn('group_id', $this->connectedGroupIds($userId))
            ->distinct()->get()->pluck('user_id')->toArray();
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function connectedUsers($userId = 0)
    {
        $userIds = $this->connectedUserIds($userId);
        return User::where('id', '<>', $userId)
            ->whereIn('id', $userIds);
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function unconnectedUsers($userId = 0)
    {
        $userIds = $this->connectedUserIds($userId);
        return User::where('id', '<>', $userId)
            ->whereNotIn('id', $userIds);
    }

    //********************    User / Subscription (Group) Relation Section *******************/

    /**
     * List of people who a user has at least one connection in a group.
     * @param null $userId
     * @return mixed
     */
    public function myCurrentUsers($userId = null)
    {
        return Subscription::whereIn('group_id', $this->connectedGroupIds($userId))
            ->where('user_id', '<>', $userId)
            ->whereIn('status', Subscription::STATUS_LIST_CONNECTED)
            ->orderBy('user_id')
            ->orderBy('group_id')
            ->orderBy('invited_by_id');
    }

    /**
     * TODO to use it somewhere [ not used yet ] as [waiting requests]
     * @param int $userId
     * @return mixed
     */
    public function myPendingInvitations($userId = 0)
    {
        return Subscription::whereIn('status', Subscription::STATUS_PENDING)
            ->where('user_id', $userId)->orderBy('status');
    }

    /**
     * List of people who have been invited to a group by this user.
     * @param int $userId
     * @return mixed
     */
    public function myInvitations($userId = 0)
    {
        return Subscription::whereIn('status', Subscription::STATUS_LIST)
            ->where('invited_by_id', $userId)->orderBy('status')->orderBy('updated_at', 'desc');
    }
}
