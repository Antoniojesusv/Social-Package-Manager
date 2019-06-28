<?php
namespace App\src\MaSPack\Application\Employee\Service;

use App\src\MaSPack\Domain\Employee\EmployeeRepositoryInterface;

class ListEmployees
{
    private $employee;

    public function __construct(EmployeeRepositoryInterface $employee)
    {
        $this->employee = $employee;
    }

    public function execute(): array
    {
        return $this->employee->findAll();
    }
}
