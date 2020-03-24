<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Requests\InviteUserToGroup;
use App\Http\Resources\{
    GroupCollection,
    SubscriptionCollection,
    Subscription as SubscriptionResource,
};
use App\Services\SubscriptionService;
use App\Traits\SubscriptionTrait;

/**
 * Class SubscriptionRestController
 * @package App\Http\Controllers\ApiV1
 */
class SubscriptionRestController extends RestController
{
    use  SubscriptionTrait;

    /**
     * @var SubscriptionService
     */
    protected $service;

    /**
     * SubscriptionRestController constructor.
     */
    public function __construct()
    {
        $this->service = new SubscriptionService();
    }

    /**
     * @return GroupCollection
     */
    public function getMyGroups()
    {
        return new GroupCollection($this->getUserGroupConnections());
    }

    /**
     * @return SubscriptionCollection
     */
    public function getMyPeople()
    {
        return new SubscriptionCollection($this->getUserPeopleConnections());
    }

    /**
     * @return SubscriptionCollection
     */
    public function getMyInvitations()
    {
        return new SubscriptionCollection($this->getUserPendingInvitations());
    }

    /**
     * @param InviteUserToGroup $request
     * @return SubscriptionResource
     */
    public function inviteUserToGroup(InviteUserToGroup $request)
    {
        $invitation = $this->createSubscription($request);
        return new SubscriptionResource ($invitation);
    }


}
