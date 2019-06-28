<?php

namespace App\src\MaSPack\Application\SocialPackage\Command;

use App\src\MaSPack\Domain\SocialPackage\SocialPackagesRepositoryInterface;

class SaveSocialPackageCommand
{
    private $name;
    private $startDate;
    private $endDate;
    private $amount;
    private $description;

    public function __construct(
        string $name,
        string $startDate,
        string $endDate,
        float $amount,
        ?string $description
    ) {
        $this->name = $name;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->amount = $amount;
        $this->description = $description;
    }

    public function name(): string
    {
        return $this->name;
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

    public function description(): ?string
    {
        return $this->description;
    }
}
