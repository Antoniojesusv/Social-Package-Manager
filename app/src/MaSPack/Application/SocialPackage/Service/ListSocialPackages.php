<?php

namespace App\src\MaSPack\Application\SocialPackage\Service;

use App\src\MaSPack\Domain\SocialPackage\SocialPackagesRepositoryInterface;

class ListSocialPackages
{
    private $socialPackage;

    public function __construct(SocialPackagesRepositoryInterface $socialPackage)
    {
        $this->socialPackage = $socialPackage;
    }

    public function execute(): array
    {
        return $this->socialPackage->findAll();
    }
}
