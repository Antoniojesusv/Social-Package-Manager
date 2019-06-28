<?php

namespace app\src\MaSPack\Application\SocialPackage\Command;

class DeleteSocialPackageCommand
{
    private $socialPackageId;

    public function __construct(int $id)
    {
        $this->socialPackageId = $id;
    }

    public function socialPackageId(): int
    {
        return $this->socialPackageId;
    }
}
