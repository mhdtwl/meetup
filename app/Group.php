<?php

namespace App;

use App\Traits\SweetlyTimingTrait;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use SweetlyTimingTrait;

    const VISIBLE_GROUP_TYPES = ['closed', 'public'];
    const GROUP_TYPES = ['private', 'closed', 'public'];

    protected $type = 'private';

    public function group_interests()
    {
        return $this->hasMany(GroupInterest::class, 'group_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'group_id');
    }

}
