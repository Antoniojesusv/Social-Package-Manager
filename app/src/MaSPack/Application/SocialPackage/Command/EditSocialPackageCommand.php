<?php
    
namespace App\src\MaSPack\Application\SocialPackage\Command;

use App\src\MaSPack\Domain\SocialPackage\SocialPackagesRepositoryInterface;

class EditSocialPackageCommand
{
    private $id;
    private $name;
    private $startDate;
    private $endDate;
    private $amount;

    public function __construct(
        int $id,
        string $name,
        ?string $description,
        string $startDate,
        string $endDate,
        float $amount
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->amount = $amount;
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
}
