<?php

namespace App\src\MaSPack\Application\SocialPackage\CommandHandler;

use App\src\MaSPack\Domain\SocialPackage\SocialPackagesRepositoryInterface;
use App\src\MaSPack\Application\SocialPackage\Command\DeleteSocialPackageCommand;
use App\src\MaSPack\Infrastructure\Exceptions\SocialPackageNotFoundException;
use App\src\MaSPack\Domain\SocialPackage\SocialPackageEntity;

class DeleteSocialPackageCommandHandler
{
    private $socialPackageRepository;

    public function __construct(SocialPackagesRepositoryInterface $socialPackageRepository)
    {
        $this->socialPackageRepository = $socialPackageRepository;
    }
    
    public function handle(DeleteSocialPackageCommand $deleteCommand): void
    {
        $socialPackageEntity = $this->socialPackageRepository->findOneById($deleteCommand->socialPackageId());

        if (empty($socialPackageEntity)) {
            throw new SocialPackageNotFoundException("Social Package could not be found");
        }

        $this->socialPackageRepository->delete($socialPackageEntity);
    }
}
