<?php

namespace App\src\MaSPack\Application\SocialPackage\Service;

use App\src\MaSPack\Domain\SocialPackage\SocialPackagesRepositoryInterface;
use App\src\MaSPack\Domain\SocialPackage\SocialPackageEntity;

class FindSocialPackage
{
    private $socialPackageRepository;

    public function __construct(SocialPackagesRepositoryInterface $socialPackageRepository)
    {
        $this->socialPackageRepository = $socialPackageRepository;
    }

    public function execute(int $id): SocialPackageEntity
    {
        return $this->socialPackageRepository->findOneById($id);
    }
}
