<?php

namespace App\src\MaSPack\Application\SocialPackage\CommandHandler;

use App\src\MaSPack\Domain\SocialPackage\SocialPackagesRepositoryInterface;
use App\src\MaSPack\Application\SocialPackage\Command\EditSocialPackageCommand;
use App\src\MaSPack\Application\Exceptions\SocialPackageNotFoundException;

class EditSocialPackageCommandHandler
{
    private $socialPackageRepository;

    public function __construct(SocialPackagesRepositoryInterface $socialPackageRepository)
    {
        $this->socialPackageRepository = $socialPackageRepository;
    }

    public function handle(EditSocialPackageCommand $command)
    {
        $socialPackageEntity = $this->socialPackageRepository->findOneById($command->id());

        if (empty($socialPackageEntity)) {
            throw new SocialPackageNotFoundException("Social Package could not be found");
        }

        $socialPackageEntity->changeName($command->name());
        $socialPackageEntity->changeDescription($command->description());
        $socialPackageEntity->changeDates($command->startDate(), $command->endDate());
        $socialPackageEntity->changeAmount($command->amount());

        $this->socialPackageRepository->save($socialPackageEntity);
    }
}
