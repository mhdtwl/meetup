<?php

namespace App;

use App\Http\Controllers\Controller;
use App\Traits\SweetlyTimingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * add my people to group of mine
 * add my self to a group ( RSVP ) -- not important
 * Subscription represents a connection user to a group
 * Class Subscription
 * @package App
 */
class Subscription extends Model
{
    use SweetlyTimingTrait;
    /**
     * table_name = subscriptions
     * ------------------------------------------
     *  pending : out of group | has a request to join  the group. [needs an approval, user or group admin]
     *  canceled:   inactive member
     *  active : in group  | active member
     *  left:       inactive member
     *  blocked : out of group  | blocked from this group
     */

    const STATUS_PENDING = 'pending';
    const STATUS_ACTIVE = 'active';
    const STATUS_CANCELED = 'cancelled';
    const STATUS_LEFT = 'left';
    const STATUS_BLOCKED = 'blocked';

    const STATUS_LIST_CONNECTED = [Subscription::STATUS_PENDING, Subscription::STATUS_ACTIVE];
    const STATUS_LIST = [
        Subscription::STATUS_PENDING,
        Subscription::STATUS_ACTIVE,
        Subscription::STATUS_CANCELED,
        Subscription::STATUS_LEFT,
        Subscription::STATUS_BLOCKED
    ];

    const PAGINATION_OFFSET = 12;


    /**
     * @param $groupId
     * @param $userId
     * @param $invitedById
     * @param string $status
     */
    public function assignAttributes(
        $groupId = null,
        $userId = null,
        $invitedById = null,
        $status = Subscription::STATUS_PENDING
    ) {
        $this->group_id = $groupId;
        $this->user_id = $userId;
        $this->invited_by_id = $invitedById;
        $this->status = $status;
    }

    //---------------------- Checks --------------------
    public static function getSubscription($groupId, $userId, $status = Subscription::STATUS_ACTIVE)
    {
        dd(Subscription::where('group_id', $groupId)
            ->where('user_id', $userId)
            ->get()
            ->first());
        return $x;
    }

    public static function checkExistence($groupId, $userId)
    {
        $count = Subscription::where('group_id', $groupId)
            ->where('user_id', $userId)
            ->get()->count();
        return ($count > 0) ? true : false;
    }

    //----------------------User / Group Relation --------------------
    private static function connectedGroupIds($userId)
    {
        return Subscription::whereIn('status', Subscription::STATUS_LIST_CONNECTED)
            ->where('user_id', $userId)
            ->get()->pluck('group_id')->toArray();
    }

    /**
     * The Groups of user can see and he's a member.
     * @param $userId
     * @return \Illuminate\Support\Collection
     */
    /**
     * @param $userId
     * @return mixed
     */
    public static function connectedGroups($userId)
    {
        return Group::whereIn('id', Subscription::connectedGroupIds($userId));//->get();
    }

    /**
     * The Groups of user can see but not in.
     * @param $userId
     * @return \Illuminate\Support\Collection
     */
    public static function unconnectedGroups($userId)// I am not in  [ RSVP ]
    {
        $getGroupAllStatusIds = Subscription::where('user_id', $userId)
            ->get()->pluck('group_id')->toArray();
        // todo to keep or to remove. // ->where('invited_by_id', '<>', $userId)
        return Group::whereIn('type', Group::VISIBLE_GROUP_TYPES)
            ->whereNotIn('id', $getGroupAllStatusIds)
            ->get();
    }

    ///------------------------User / User Relation ------------------
    private static function connectedUserIds($userId)
    {
        return Subscription::whereIn('group_id', Subscription::connectedGroupIds($userId))
            ->distinct()->get()->pluck('user_id')->toArray();
    }

    /**
     * @param $userId
     * @return \Illuminate\Support\Collection
     */
    public static function connectedUsers($userId)
    {
        $userIds = Subscription::connectedUserIds($userId);
        return User::where('id', '<>', $userId)
            ->whereIn('id', $userIds);
    }

    public static function unconnectedUsers($userId)
    {
        $userIds = Subscription::connectedUserIds($userId);
        return User::where('id', '<>', $userId)
            ->whereNotIn('id', $userIds); //->paginate(Controller::PAGINATION_OFFSET);//->get();
    }


    ///-------------------- User / Subscription (Group) Relation  ----------------------
    /**
     * List of people who a user has at least one connection in a group.
     * @param $userId
     * @return mixed
     */
    public static function myCurrentUsers($userId)
    {
        return  Subscription::whereIn('group_id', Subscription::connectedGroupIds($userId))
                ->where('user_id', '<>' , $userId)
                ->whereIn('status', Subscription::STATUS_LIST_CONNECTED)
                ->orderBy('user_id')
                ->orderBy('group_id')
                ->orderBy('invited_by_id');
    }
    /**
     * @param $userId
     * @return mixed
     */
    public static function myPendingInvitations($userId)
    {
        return Subscription::whereIn('status', Subscription::STATUS_PENDING)
            ->where('user_id', $userId)->orderBy('status');
    }

    /**
     * List of people who have been invited to a group by this user.
     * @param $userId
     * @return mixed
     */
    public static function myInvitations($userId)
    {
        return Subscription::whereIn('status', Subscription::STATUS_LIST)
            ->where('invited_by_id', $userId)->orderBy('status');
    }

    /**
     * @param $userId
     * @return mixed
     */
    public static function myConnections($userId)
    {
        return Subscription::whereIn('status', Subscription::STATUS_LIST_CONNECTED)
            ->where('user_id', $userId)->orderBy('status');
    }

    ///----------------------- Eloquent Relations -------------------
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function invited_by()
    {
        return $this->belongsTo(User::class, 'invited_by_id');
    }
}
