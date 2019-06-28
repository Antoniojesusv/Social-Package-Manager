<?php
namespace Tests\Unit\Application\Employee\CommandHandler;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

use App\src\MaSPack\Application\FileReader\FileReaderInterface;
use App\src\MaSPack\Domain\Employee\EmployeeRepositoryInterface;
use App\src\MaSPack\Application\Employee\CommandHandler\ImportEmployeesCommandHandler;
use App\src\MaSPack\Application\Employee\Command\ImportEmployeesCommand;

/**
 * Tests\Unit\Application\Employee\CommandHandler\ImportEmployeesCommandHandlerTest
 *
 * EditSocialPackageCommandHandler unit test class.
 *
 * @group  unit
 * @group  application
 * @group  employee
 *
 * @coversDefaultClass App\src\MaSPack\Application\Employee\CommandHandler\ImportEmployeesCommandHandler
 *
 * @author Carlos Cobos Toscano <Carlos.Cobos@voiceworks.com>
 */
class ImportEmployeesCommandHandlerTest extends TestCase
{
    private const COMMAND_FILE_EXTENSION_STUB = "xlsx";


    /**
     * @var ImportEmployeesCommandHandler
     */
    private $importEmployeesCommandHandler;

    /**
     * @var EmployeeRepositoryInterface|MockObject
     */
    private $employeeRepositoryMock;

    /**
     * @var FileReaderInterface|MockObject
     */
    private $fileReaderMock;

    public function testHandle()
    {
        /** @var ImportEmployeesCommand|MockObject $commandStub */
        $commandStub = $this->createMock(ImportEmployeesCommand::class);
        $commandStub->expects($this->once())->method('fileExtension')->willReturn(self::COMMAND_FILE_EXTENSION_STUB);

        $this->testCheckExtensionSupported(self::COMMAND_FILE_EXTENSION_STUB);
    }

    public function testCheckExtensionSupported()
    {

    }

    public function setUp()
    {
        $this->employeeRepositoryMock = $this->createMock(EmployeeRepositoryInterface::class);
        $this->fileReaderMock = $this->createMock(FileReaderInterface::class);

        $this->importEmployeesCommandHandler = new ImportEmployeesCommandHandler(
            $this->employeeRepositoryMock,
            $this->fileReaderMock
        );
    }
}
