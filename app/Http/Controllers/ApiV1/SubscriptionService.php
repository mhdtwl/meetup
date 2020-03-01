<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Http\Requests\InviteUserToGroup;
use App\Http\Resources\{
    UserCollection,
    GroupCollection,
    SubscriptionCollection,
    Subscription as SubscriptionResource,
};
use App\Traits\SubscriptionTrait;

class SubscriptionService extends Controller
{
    use  SubscriptionTrait;

    public function getMyGroups()
    {
        return new GroupCollection($this->getUserGroupConnections());
    }

    public function getMyPeople()
    {
        return new UserCollection($this->getUserPeopleConnections());
    }

    public function getMyInvitations()
    {
        return new SubscriptionCollection($this->getUserPendingInvitations());
    }

    public function inviteUserToGroup(InviteUserToGroup $request)
    {
        $invitation = $this->createSubscription($request);
        if ($invitation) {
            return new SubscriptionResource ($invitation);
        }
    }


}
