<?php

namespace App\src\MaSPack\Domain\Subscription;

class SubscriptionEntity
{
    private $name;
    private $startDate;
    private $endDate;
    private $amount;

    public function __construct(
        string $name,
        string $startDate,
        string $endDate,
        float $amount
    ) {
        $this->name = $name;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->amount = $amount;
    }

    public function name()
    {
        return $this->name;
    }

    public function startDate()
    {
        return $this->startDate;
    }

    public function endDate()
    {
        return $this->endDate;
    }

    public function amount()
    {
        return $this->amount;
    }
}
