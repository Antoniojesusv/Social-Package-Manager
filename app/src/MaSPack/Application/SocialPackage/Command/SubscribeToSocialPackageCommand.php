<?php
namespace App\src\MaSPack\Application\SocialPackage\Command;

class SubscribeToSocialPackageCommand
{
    private $idSocialPackage;
    private $idEmployee;
    private $startDate;
    private $endDate;
    private $amount;

    public function __construct(int $idSocialPackage, int $idEmployee, string $startDate, string $endDate, float $amount)
    {
        $this->idSocialPackage = $idSocialPackage;
        $this->idEmployee = $idEmployee;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->amount = $amount;
    }

    public function idSocialPackage(): int
    {
        return $this->idSocialPackage;
    }

    public function idEmployee(): int 
    {
        return $this->idEmployee;
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