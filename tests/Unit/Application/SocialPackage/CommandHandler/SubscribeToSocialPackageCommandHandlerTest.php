<?php

namespace Tests\Unit\Application\SocialPackage\CommandHandler;

use App\src\MaSPack\Application\SocialPackage\Command\SubscribeToSocialPackageCommand;
use App\src\MaSPack\Application\SocialPackage\CommandHandler\SubscribeToSocialPackageCommandHandler;
use App\src\MaSPack\Domain\SocialPackage\SocialPackagesRepositoryInterface;
use App\src\MaSPack\Domain\Employee\EmployeeRepositoryInterface;
use App\src\MaSPack\Domain\SocialPackage\SocialPackageEntity;
use App\src\MaSPack\Domain\Employee\EmployeeEntity;
use App\src\MaSPack\Application\Exceptions\SocialPackageNotFoundException;
use App\src\MaSPack\Application\Exceptions\EmployeeNotFoundException;
use App\src\MaSPack\Application\Exceptions\InvalidDateFormatException;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Tests\Unit\Application\SocialPackage\CommandHandler\SubscribeToSocialPackageCommandHandlerTest
 *
 * SubscribeToSocialPackageCommandHandler unit test class.
 *
 * @group  unit
 * @group  application
 * @group  socialPackage
 *
 * @coversDefaultClass App\src\MaSPack\Application\SocialPackage\CommandHandler\SubscribeToSocialPackageCommandHandler
 *
 * @author Elise Gielen <elise.gielen@voiceworks.com>
 */
class SubscribeToSocialPackageCommandHandlerTest extends TestCase
{
    private const COMMAND_ID_SOCIAL_PACKAGE_STUB = 2;
    private const COMMAND_ID_EMPLOYEE_STUB = 1;
    private const COMMAND_START_DATE_STUB = '2019-05-01';
    private const COMMAND_END_DATE_STUB = '2019-06-01';
    private const COMMAND_AMOUNT_STUB = 12.5;

    private const SOCIAL_PACKAGE_START_DATE_STUB = '2019-04-28';
    private const SOCIAL_PACKAGE_END_DATE_STUB = '2019-06-03';

    private const SOCIAL_PACKAGE_BAD_FORMAT_START_DATE_STUB = [
        'MM/DD/YY' => '2019/04/28',
        'DD/MM/YY' => '28/04/2019'
    ];

    private const SOCIAL_PACKAGE_BAD_FORMAT_END_DATE_STUB = [
        'MM/DD/YY' => '2019/06/03',
        'DD/MM/YY' => '03/06/2019'
    ];

    private const SOCIAL_PACKAGE_SUBSCRIBE_VALUE = true;

    private const NULL_STUB = null;

    /**
     * @var SubscribeToSocialPackageCommandHandler
     */
    private $subscribeToSocialPackageCommandHandler;

    /**
     * @var SocialPackagesRepositoryInterface|MockObject
     */
    private $socialPackageRepositoryMock;

    /**
    *  @var EmployeeRepositoryInterface|MockObject
    */

    private $employeeRepositoryMock;

    public function testHandle()
    {
        /** @var SubscribeToSocialPackageCommand|MockObject $socialPackageCommandStub */
       
        $subscribeToSocialPackageCommandMock = $this->createMock(SubscribeToSocialPackageCommand::class);

        /** @var SocialPackageEntity|MockObject $socialPackageCommandStub */
       
        $socialPackageEntityMock = $this->createMock(SocialPackageEntity::class);

        /** @var EmployeeEntity|MockObject $socialPackageCommandStub */
       
        $employeeMock = $this->createMock(EmployeeEntity::class);

        $subscribeToSocialPackageCommandMock->expects($this->exactly(2))->method('idSocialPackage')->willReturn(self::COMMAND_ID_SOCIAL_PACKAGE_STUB);
        $subscribeToSocialPackageCommandMock->expects($this->exactly(2))->method('idEmployee')->willReturn(self::COMMAND_ID_EMPLOYEE_STUB);
        $subscribeToSocialPackageCommandMock->expects($this->exactly(3))->method('startDate')->willReturn(self::COMMAND_START_DATE_STUB);
        $subscribeToSocialPackageCommandMock->expects($this->exactly(3))->method('endDate')->willReturn(self::COMMAND_END_DATE_STUB);
        $subscribeToSocialPackageCommandMock->expects($this->exactly(2))->method('amount')->willReturn(self::COMMAND_AMOUNT_STUB);

        $this->socialPackageRepositoryMock->expects($this->once())->method('findOneById')->with(self::COMMAND_ID_SOCIAL_PACKAGE_STUB)->willReturn($socialPackageEntityMock);

        $this->employeeRepositoryMock->expects($this->once())->method('findById')->with(self::COMMAND_ID_EMPLOYEE_STUB)->willReturn($employeeMock);


        $socialPackageEntityMock->expects($this->once())->method('subscribe')->with(self::COMMAND_START_DATE_STUB, self::COMMAND_END_DATE_STUB, self::COMMAND_AMOUNT_STUB)->willReturn(true);

        $this->socialPackageRepositoryMock->expects($this->once())->method('subscribeEmployeeToSocialPackage')->with(
            self::COMMAND_ID_SOCIAL_PACKAGE_STUB,
            self::COMMAND_ID_EMPLOYEE_STUB,
            self::COMMAND_START_DATE_STUB,
            self::COMMAND_END_DATE_STUB,
            self::COMMAND_AMOUNT_STUB
        );

        $this->subscribeToSocialPackageCommandHandler->handle($subscribeToSocialPackageCommandMock);
    }

    public function testHandleShouldThrowSocialPackageNotFoundException()
    {
        /** @var SubscribeToSocialPackageCommand|MockObject $socialPackageCommandStub */
       
        $subscribeToSocialPackageCommandMock = $this->createMock(SubscribeToSocialPackageCommand::class);

        /** @var SocialPackageEntity|MockObject $socialPackageCommandStub */
       
        $socialPackageEntityMock = $this->createMock(SocialPackageEntity::class);

        /** @var EmployeeEntity|MockObject $socialPackageCommandStub */
       
        $employeeMock = $this->createMock(EmployeeEntity::class);

        $subscribeToSocialPackageCommandMock->expects($this->once())->method('idSocialPackage')->willReturn(self::COMMAND_ID_SOCIAL_PACKAGE_STUB);
        $subscribeToSocialPackageCommandMock->expects($this->once())->method('idEmployee')->willReturn(self::COMMAND_ID_EMPLOYEE_STUB);
        
        $this->socialPackageRepositoryMock->expects($this->once())->method('findOneById')->with(self::COMMAND_ID_SOCIAL_PACKAGE_STUB)->willReturn(self::NULL_STUB);
        $this->employeeRepositoryMock->expects($this->once())->method('findById')->with(self::COMMAND_ID_EMPLOYEE_STUB)->willReturn($employeeMock);

        $this->expectException(SocialPackageNotFoundException::class);

        $this->subscribeToSocialPackageCommandHandler->handle($subscribeToSocialPackageCommandMock);
    }

    public function testHandleShouldThrowEmployeeNotFoundException()
    {
        /** @var SubscribeToSocialPackageCommand|MockObject $socialPackageCommandStub */
       
        $subscribeToSocialPackageCommandMock = $this->createMock(SubscribeToSocialPackageCommand::class);

        /** @var SocialPackageEntity|MockObject $socialPackageCommandStub */
       
        $socialPackageEntityMock = $this->createMock(SocialPackageEntity::class);

        /** @var EmployeeEntity|MockObject $socialPackageCommandStub */
       
        $employeeMock = $this->createMock(EmployeeEntity::class);

        $subscribeToSocialPackageCommandMock->expects($this->once())->method('idSocialPackage')->willReturn(self::COMMAND_ID_SOCIAL_PACKAGE_STUB);
        $subscribeToSocialPackageCommandMock->expects($this->once())->method('idEmployee')->willReturn(self::COMMAND_ID_EMPLOYEE_STUB);
        
        $this->socialPackageRepositoryMock->expects($this->once())->method('findOneById')->with(self::COMMAND_ID_SOCIAL_PACKAGE_STUB)->willReturn($socialPackageEntityMock);
        $this->employeeRepositoryMock->expects($this->once())->method('findById')->with(self::COMMAND_ID_EMPLOYEE_STUB)->willReturn(self::NULL_STUB);

        $this->expectException(EmployeeNotFoundException::class);

        $this->subscribeToSocialPackageCommandHandler->handle($subscribeToSocialPackageCommandMock);
    }

    public function setUp()
    {
        $this->socialPackageRepositoryMock = $this->createMock(SocialPackagesRepositoryInterface::class);
        $this->employeeRepositoryMock = $this->createMock(EmployeeRepositoryInterface::class);

        $this->subscribeToSocialPackageCommandHandler = new SubscribeToSocialPackageCommandHandler(
            $this->socialPackageRepositoryMock,
            $this->employeeRepositoryMock
        );
    }
}
