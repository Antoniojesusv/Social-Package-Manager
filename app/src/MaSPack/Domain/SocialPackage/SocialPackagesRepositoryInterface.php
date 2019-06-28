<?php

namespace App\src\MaSPack\Domain\SocialPackage;

interface SocialPackagesRepositoryInterface
{
    public function findAll(): array;
    public function findOneById(int $id): ?SocialPackageEntity;
    public function findSocialPackageSubscriptions(int $id): array;
    public function save(SocialPackageEntity $socialPackage);
    public function subscribeEmployeeToSocialPackage(
        int $idSocialPackage,
        int $idEmployee,
        string $startDate,
        string $endDate,
        float $amount
    ): void;
}
