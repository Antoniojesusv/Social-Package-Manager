<?php

namespace Tests\Unit\Application\SocialPackage\CommandHandler;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use App\src\MaSPack\Domain\SocialPackage\SocialPackagesRepositoryInterface;
use App\src\MaSPack\Application\SocialPackage\CommandHandler\EditSocialPackageCommandHandler;
use App\src\MaSPack\Application\SocialPackage\Command\EditSocialPackageCommand;
use App\src\MaSPack\Domain\SocialPackage\SocialPackageEntity;

/**
 * Tests\Unit\Application\SocialPackage\CommandHandler\EditSocialPackageCommandHandlerTest
 *
 * EditSocialPackageCommandHandler unit test class.
 *
 * @group  unit
 * @group  application
 * @group  socialPackage
 *
 * @coversDefaultClass App\src\MaSPack\Application\SocialPackage\CommandHandler\EditSocialPackageCommandHandler
 *
 * @author Carlos Cobos Toscano <Carlos.Cobos@voiceworks.com>
 */
class EditSocialPackageCommandHandlerTest extends TestCase
{
    private const COMMAND_ID_STUB = 2;
    private const COMMAND_NAME_STUB = 'my Name';
    private const COMMAND_DESCRIPTION_STUB = 'my Description';
    private const COMMAND_START_DATE_STUB = '2019-05-29';
    private const COMMAND_END_DATE_STUB = '2019-05-30';
    private const COMMAND_AMOUNT_STUB = 123;

    /**
     * @var EditSocialPackageCommandHandler
     */
    private $editSocialPackageCommandHandler;

    /**
     * @var SocialPackageRepositoryInterface|MockObject
     */
    private $socialPackageRepositoryMock;

    public function testHandle()
    {
        /** @var EditSocialPackageCommand|MockObject $commandStub */
        $commandStub = $this->createMock(EditSocialPackageCommand::class);
        $commandStub->expects($this->once())->method('id')->willReturn(self::COMMAND_ID_STUB);

        /** @var SocialPackageEntity|MockObject $socialPackageStub */
        $socialPackageStub = $this->createMock(SocialPackageEntity::class);
        $this->socialPackageRepositoryMock->expects($this->once())->method('find')->with(self::COMMAND_ID_STUB)->willReturn($socialPackageStub);

        $commandStub->expects($this->once())->method('name')->willReturn(self::COMMAND_NAME_STUB);
        $socialPackageStub->expects($this->once())->method('changeName')->with(self::COMMAND_NAME_STUB);

        $commandStub->expects($this->once())->method('description')->willReturn(self::COMMAND_DESCRIPTION_STUB);
        $socialPackageStub->expects($this->once())->method('changeDescription')->with(self::COMMAND_DESCRIPTION_STUB);

        $commandStub->expects($this->once())->method('startDate')->willReturn(self::COMMAND_START_DATE_STUB);
        $commandStub->expects($this->once())->method('endDate')->willReturn(self::COMMAND_END_DATE_STUB);
        $socialPackageStub->expects($this->once())->method('changeDates')->with(self::COMMAND_START_DATE_STUB, self::COMMAND_END_DATE_STUB);

        $commandStub->expects($this->once())->method('amount')->willReturn(self::COMMAND_AMOUNT_STUB);
        $socialPackageStub->expects($this->once())->method('changeAmount')->with(self::COMMAND_AMOUNT_STUB);

        $this->socialPackageRepositoryMock->expects($this->once())->method('saveSocialPackage')->with($socialPackageStub);

        $this->editSocialPackageCommandHandler->handle($commandStub);
    }

    public function setUp()
    {
        $this->socialPackageRepositoryMock = $this->createMock(SocialPackagesRepositoryInterface::class);

        $this->editSocialPackageCommandHandler = new EditSocialPackageCommandHandler(
            $this->socialPackageRepositoryMock
        );
    }
}
