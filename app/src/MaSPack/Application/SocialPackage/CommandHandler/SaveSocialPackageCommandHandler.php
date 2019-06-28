<?php

namespace App\src\MaSPack\Application\SocialPackage\CommandHandler;

use App\src\MaSPack\Domain\SocialPackage\SocialPackagesRepositoryInterface;
use App\src\MaSPack\Application\SocialPackage\Command\SaveSocialPackageCommand;
use App\src\MaSPack\Domain\SocialPackage\SocialPackageEntity;

class SaveSocialPackageCommandHandler
{
    private $socialPackageRepository;

    public function __construct(SocialPackagesRepositoryInterface $socialPackageRepository)
    {
        $this->socialPackageRepository = $socialPackageRepository;
    }

    public function handle(SaveSocialPackageCommand $command): void
    {
        $socialPackage = new SocialPackageEntity(
            $command->name(),
            $command->startDate(),
            $command->endDate(),
            $command->amount(),
            null,
            $command->description()
        );

        $this->socialPackageRepository->save($socialPackage);
    }
}
