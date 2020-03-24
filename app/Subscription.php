<?php

namespace App;

use App\Traits\SweetlyTimingTrait;
use Illuminate\Database\Eloquent\Model;

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
