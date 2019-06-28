<?php

namespace App\src\MaSPack\Domain\Subscription;

interface SubscriptionRepositoryInterface
{
    public function findAllById(int $id): array;
}
