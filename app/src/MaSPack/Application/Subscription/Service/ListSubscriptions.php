<?php

namespace App\src\MaSPack\Application\Subscription\Service;

use App\src\MaSPack\Domain\Subscription\SubscriptionRepositoryInterface;

class ListSubscriptions
{
    private $subscriptionRepository;

    public function __construct(SubscriptionRepositoryInterface $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function execute(int $id): array
    {
        return $this->subscriptionRepository->findAllById($id);
    }
}
