<?php
namespace App\src\MaSPack\Infrastructure\Persistence\Eloquent;

use App\src\MaSPack\Domain\Employee\EmployeeEntity;
use App\src\MaSPack\Infrastructure\Persistence\Eloquent\EmployeeModel;
use App\src\MaSPack\Domain\Employee\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\src\MaSPack\Infrastructure\Exceptions\EmployeeCouldNotBeReadedException;
use App\src\MaSPack\Infrastructure\Exceptions\EmployeeCouldNotBeStoredException;
use App\src\MaSPack\Infrastructure\Exceptions\EmployeeCouldNotBeDeletedException;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function findAll(): array
    {
        try {
            $socialPackagesRecordset = EmployeeModel::all();

            return $this->generateListOfEmployees($socialPackagesRecordset);
        } catch (PDOException $th) {
            throw new EmployeeCouldNotBeReadedException();
        }
    }

    private function generateListOfEmployees(object $socialPackagesRecordset): array
    {
        $listOfEmployees = [];

        foreach ($socialPackagesRecordset as $employee) {
            $listOfEmployees[] = new EmployeeEntity(
                $employee->name,
                $employee->email,
                $employee->id
            );
        }

        return $listOfEmployees;
    }

    public function saveEmployees(array $employeeArray)
    {
        foreach ($employeeArray as $employee) {
            $this->saveEmployee($employee);
        }
    }

    private function saveEmployee(EmployeeEntity $employee)
    {
        $employeeModel = new EmployeeModel();

        $employeeModel->name = $employee->name();
        $employeeModel->email = $employee->email();

        try {
            $employeeModel->save();
        } catch (PDOException $th) {
            ;
            throw new EmployeeCouldNotBeStoredException();
        }
    }

    public function deteleAllEmployees()
    {
        $authUserId = Auth::id();

        try {
            $allEmployees = EmployeeModel::where('id', '!=', $authUserId);

            foreach ($allEmployees as $employee) {
                $employee->delete();
            }
        } catch (PDOException $th) {
            throw new EmployeeCouldNotBeDeletedException();
        }
    }
    
    public function findById(int $id): ?EmployeeEntity
    {
        $employeeModel = $this->findModel($id);
        if (empty($employeeModel)) {
            return $employeeModel;
        }
        return new EmployeeEntity(
            $employeeModel->name,
            $employeeModel->email,
            $employeeModel->id
        );
    }

    private function findModel(int $id): EmployeeModel
    {
        return EmployeeModel::find($id);
    }
}
