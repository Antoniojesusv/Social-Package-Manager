<?php

namespace App\src\MaSPack\Domain\SocialPackage;

use App\src\MaSPack\Domain\Exceptions\InvalidDateException;
use App\src\MaSPack\Domain\Exceptions\InvalidSubscriptionDateException;
use App\src\MaSPack\Domain\Exceptions\InvalidAmountDateException;

class SocialPackageEntity
{
    private $id;
    private $name;
    private $description;
    private $endDate;
    private $startDate;
    private $amount;
    private $subscribers;

    public function __construct(
        string $name,
        string $startDate,
        string $endDate,
        float $amount,
        int $id = null,
        ?string $description,
        ?array $subscribers = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->changeDates($startDate, $endDate);
        $this->changeAmount($amount);
        $this->subscribers = $subscribers;
    }

    public function subscribe(string $startDate, string $endDate, float $amount): bool
    {
        if (!$this->datesAreInOrder($startDate, $endDate)) {
            throw new InvalidDateException("Start date should come before end date");
        }
        
        if (!$this->datesAreInOrder($this->startDate, $startDate)) {
            throw new InvalidSubscriptionDateException("Subscription start date doesn't fall within social package period");
        }
        
        if (!$this->datesAreInOrder($endDate, $this->endDate)) {
            throw new InvalidSubscriptionDateException("Subscription end date doesn't fall within social package period");
        }
        
        if (!$this->amountIsValid($amount)) {
            throw new InvalidAmountException("Amount can't be negative");
        }
        return true;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function startDate(): string
    {
        return $this->startDate;
    }

    public function endDate(): string
    {
        return $this->endDate;
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public function addSubscriber($subscribers): void
    {
        $this->subscribers[] = $subscribers;
    }

    public function changeId(int $id)
    {
        $this->id = $id;
    }

    public function changeName(string $name)
    {
        $this->name = $name;
    }

    public function changeDescription(?string $description)
    {
        $this->description = $description;
    }

    public function changeDates(string $startDate, string $endDate)
    {
        if (!$this->isValidDate($startDate, $endDate)) {
            throw new \InvalidArgumentException("Start date should come before end date");
        }

        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function changeAmount(float $amount)
    {
        if (!$this->isValidAmount($amount)) {
            throw new \InvalidArgumentException("Amount should not be negative");
        }

        $this->amount = $amount;
    }

    public function hasExistingId(): bool
    {
        return (!is_null($this->id));
    }

    private function isValidDate(string $startDate, string $endDate): bool
    {
        return strcasecmp($startDate, $endDate) <= 0;
    }

    private function isValidAmount(float $amount): bool
    {
        return $amount >= 0;
    }

    private function datesAreInOrder(string $startDate, string $endDate): bool
    {
        return strcasecmp($startDate, $endDate) <= 0;
    }

    private function amountIsValid(float $amount): bool
    {
        return $amount >= 0;
    }
}
