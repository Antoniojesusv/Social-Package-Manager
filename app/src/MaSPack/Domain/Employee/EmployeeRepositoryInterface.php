<?php

namespace App\src\MaSPack\Domain\Employee;

use App\src\MaSPack\Domain\Employee\EmployeeEntity;

interface EmployeeRepositoryInterface
{
    public function findAll(): array;
    public function saveEmployees(array $employeeArray);
    public function deteleAllEmployees();
    public function findById(int $id): ?EmployeeEntity;
}
