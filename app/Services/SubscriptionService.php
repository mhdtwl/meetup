<?php

namespace App\Services;

use App\Repositories\SubscriptionRepository;

/**
 * Class SubscriptionService
 * @package App\Services
 */
class SubscriptionService
{
    /**
     * @var SubscriptionRepository
     */
    private $repository;

    /**
     * SubscriptionService constructor.
     */
    public function __construct()
    {
        $this->repository = new SubscriptionRepository();
    }

    /**
     * @return SubscriptionRepository
     */
    public function getRepository(): SubscriptionRepository
    {
        return $this->repository;
    }

    /**
     * @param SubscriptionRepository $repository
     */
    public function setRepository(SubscriptionRepository $repository): void
    {
        $this->repository = $repository;
    }

}
