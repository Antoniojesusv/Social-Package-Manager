<?php
namespace App\src\MaSPack\Application\SocialPackage\Service;

use App\src\MaSPack\Domain\SocialPackage\SocialPackagesRepositoryInterface;

class ListSocialPackageSubscriptions
{
    private $socialPackageRepository;

    public function __construct(SocialPackagesRepositoryInterface $socialPackageRepository)
    {
        $this->socialPackageRepository = $socialPackageRepository;
    }

    public function execute(int $id): array
    {
        return $this->socialPackageRepository->findSocialPackageSubscriptions($id);
    }
}