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
     * @param int $groupId
     * @param int $userId
     * @param int $invitedById
     * @param string $status
     */
    public function assignAttributes(
        $groupId = 0,
        $userId = 0,
        $invitedById = 0,
        $status = Subscription::STATUS_PENDING
    ) {
        $this->group_id = $groupId;
        $this->user_id = $userId;
        $this->invited_by_id = $invitedById;
        $this->status = $status;
    }

    /********************    User / Group Relation  *******************
     * @param int $userId
     * @return mixed
     */
    private static function connectedGroupIds($userId=0)
    {
        return Subscription::whereIn('status', Subscription::STATUS_LIST_CONNECTED)
            ->where('user_id', $userId)
            ->get()->pluck('group_id')->toArray();
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public static function connectedGroups($userId=0)
    {
        return Group::whereIn('id', Subscription::connectedGroupIds($userId));
    }

    /**
     * TODO to use it somewhere [ not in use ] as  [ RSVP ]
     * The Groups of user can see but not in.
     * @param int $userId
     * @return mixed
     */
    public static function unconnectedGroups($userId=0)
    {
        $getGroupAllStatusIds = Subscription::where('user_id', $userId)
            ->get()->pluck('group_id')->toArray();
        return Group::whereIn('type', Group::VISIBLE_GROUP_TYPES)
            ->whereNotIn('id', $getGroupAllStatusIds)
            ->get();
    }

    /********************    User / User Relation  ******************
     * @param int $userId
     * @return mixed
     */
    private static function connectedUserIds($userId = 0)
    {
        return Subscription::whereIn('group_id', Subscription::connectedGroupIds($userId))
            ->distinct()->get()->pluck('user_id')->toArray();
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public static function connectedUsers($userId = 0)
    {
        $userIds = Subscription::connectedUserIds($userId);
        return User::where('id', '<>', $userId)
            ->whereIn('id', $userIds);
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public static function unconnectedUsers($userId = 0)
    {
        $userIds = Subscription::connectedUserIds($userId);
        return User::where('id', '<>', $userId)
            ->whereNotIn('id', $userIds);
    }

    /********************    User / Subscription (Group) Relation  *******************/
    /**
     * List of people who a user has at least one connection in a group.
     * @param null $userId
     * @return mixed
     */
    public static function myCurrentUsers($userId = null)
    {
        return Subscription::whereIn('group_id', Subscription::connectedGroupIds($userId))
            ->where('user_id', '<>', $userId)
            ->whereIn('status', Subscription::STATUS_LIST_CONNECTED)
            ->orderBy('user_id')
            ->orderBy('group_id')
            ->orderBy('invited_by_id');
    }

    /**
     * TODO to use it somewhere [ not in use ] as waiting request
     * @param int $userId
     * @return mixed
     */
    public static function myPendingInvitations($userId = 0)
    {
        return Subscription::whereIn('status', Subscription::STATUS_PENDING)
            ->where('user_id', $userId)->orderBy('status');
    }

    /**
     * List of people who have been invited to a group by this user.
     * @param int $userId
     * @return mixed
     */
    public static function myInvitations($userId = 0)
    {
        return Subscription::whereIn('status', Subscription::STATUS_LIST)
            ->where('invited_by_id', $userId)->orderBy('status')->orderBy('updated_at', 'desc');
    }


    /********************    Eloquent Relations  *******************/
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
