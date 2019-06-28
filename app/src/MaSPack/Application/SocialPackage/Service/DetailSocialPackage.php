<?php

namespace App\src\MaSPack\Application\SocialPackage\Service;

use App\src\MaSPack\Domain\SocialPackage\SocialPackageEntity;
use App\src\MaSPack\Domain\SocialPackage\SocialPackagesRepositoryInterface;

class DetailSocialPackage
{
    private $socialPackage;

    public function __construct(SocialPackagesRepositoryInterface $socialPackage)
    {
        $this->socialPackage = $socialPackage;
    }

    public function execute(int $id): SocialPackageEntity
    {
        return $this->socialPackage->findOneById($id);
    }
}
