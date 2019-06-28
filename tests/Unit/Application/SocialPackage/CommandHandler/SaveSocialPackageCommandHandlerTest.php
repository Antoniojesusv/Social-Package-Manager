<?php

namespace Tests\Unit\Application\SocialPackage\CommandHandler;

use App\src\MaSPack\Application\SocialPackage\Command\SaveSocialPackageCommand;
use App\src\MaSPack\Application\SocialPackage\CommandHandler\SaveSocialPackageCommandHandler;
use App\src\MaSPack\Domain\SocialPackage\SocialPackagesRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Tests\Unit\Application\SocialPackage\CommandHandler\SaveSocialPackageCommandHandlerTest
 *
 * SaveSocialPackageCommandHandler unit test class.
 *
 * @group  unit
 * @group  application
 * @group  socialPackage
 *
 * @coversDefaultClass App\src\MaSPack\Application\SocialPackage\CommandHandler\SaveSocialPackageCommandHandler
 *
 * @author Jose Antonio Martin Fernandez <jose.martin@voiceworks.com>
 */
class SaveSocialPackageCommandHandlerTest extends TestCase
{
    private const COMMAND_NAME_STUB = 'my Name';
    private const COMMAND_DESCRIPTION_STUB = 'my Description';
    private const COMMAND_START_DATE_STUB = '2019-05-29';
    private const COMMAND_END_DATE_STUB = '2019-05-30';
    private const COMMAND_AMOUNT_STUB = 123;

    /**
     * @var SaveSocialPackageCommandHandler
     */
    private $saveSocialPackageCommandHandler;

    /**
     * @var SocialPackagesRepositoryInterface|MockObject
     */
    private $socialPackageRepositoryMock;

    public function testHandle()
    {
        /** @var SaveSocialPackageCommand|MockObject $socialPackageCommandStub */
        $socialPackageCommandStub = $this->createMock(SaveSocialPackageCommand::class);

        $socialPackageCommandStub->expects($this->once())->method('name')->
        willReturn(self::COMMAND_NAME_STUB);
        
        $socialPackageCommandStub->expects($this->once())->method('description')->
        willReturn(self::COMMAND_DESCRIPTION_STUB);

        $socialPackageCommandStub->expects($this->once())->method('startDate')->
        willReturn(self::COMMAND_START_DATE_STUB);

        $socialPackageCommandStub->expects($this->once())->method('endDate')->
        willReturn(self::COMMAND_END_DATE_STUB);

        $socialPackageCommandStub->expects($this->once())->method('amount')->
        willReturn(self::COMMAND_AMOUNT_STUB);

        $this->socialPackageRepositoryMock->expects($this->once())->method('saveSocialPackage');

        $this->saveSocialPackageCommandHandler->handle($socialPackageCommandStub);
    }

    public function setUp()
    {
        $this->socialPackageRepositoryMock = $this->createMock(SocialPackagesRepositoryInterface::class);

        $this->saveSocialPackageCommandHandler = new SaveSocialPackageCommandHandler(
            $this->socialPackageRepositoryMock
        );
    }
}
