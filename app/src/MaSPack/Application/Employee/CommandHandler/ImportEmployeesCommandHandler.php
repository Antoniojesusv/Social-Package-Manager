<?php
namespace App\src\MaSPack\Application\Employee\CommandHandler;

use App\src\MaSPack\Domain\Employee\EmployeeRepositoryInterface;
use App\src\MaSPack\Application\FileReader\FileReaderInterface;
use App\src\MaSPack\Application\Employee\Command\ImportEmployeesCommand;
use App\src\MaSPack\Domain\Employee\EmployeeEntity;
use App\src\MaSPack\Application\Exceptions\ImportFileNotSupportedException;

class ImportEmployeesCommandHandler
{
    private $employeeRepository;
    private $fileReader;
    private $extensionsSupported = [];

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        FileReaderInterface $fileReader
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->fileReader = $fileReader;
        $this->extensionsSupported = ["xls", "xlsx"];
    }

    public function handle(ImportEmployeesCommand $command)
    {
        $this->checkExtensionSupported($command->fileExtension());

        $rawArray = $this->fileReader->readToArray(
            $command->filePath(),
            $command->fileExtension()
        );

        $arrayOfEmployees = $this->generateListOfEmployees($rawArray[0]);

        $this->employeeRepository->deteleAllEmployees();
        $this->employeeRepository->saveEmployees($arrayOfEmployees);
    }

    private function checkExtensionSupported(string $fileExtension)
    {
        if (!in_array($fileExtension, $this->extensionsSupported, true)) {
            throw new ImportFileNotSupportedException();
        }
    }

    private function generateListOfEmployees(array $rawArray): array
    {
        $arrayOfEmployees = [];

        foreach ($rawArray as $row) {
            $arrayOfEmployees[] = new EmployeeEntity(
                $row[0],
                $row[1]
            );
        }

        return $arrayOfEmployees;
    }
}
