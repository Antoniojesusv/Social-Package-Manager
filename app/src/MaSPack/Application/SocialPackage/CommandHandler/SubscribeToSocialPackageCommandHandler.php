<?php
namespace App\src\MaSPack\Application\SocialPackage\CommandHandler;

use App\src\MaSPack\Domain\SocialPackage\SocialPackagesRepositoryInterface;
use App\src\MaSPack\Domain\Employee\EmployeeRepositoryInterface;
use App\src\MaSPack\Application\SocialPackage\Command\SubscribeToSocialPackageCommand;
use App\src\MaSPack\Application\Exceptions\SocialPackageNotFoundException;
use App\src\MaSPack\Application\Exceptions\EmployeeNotFoundException;
use App\src\MaSPack\Domain\Exceptions\InvalidDateException;
use App\src\MaSPack\Domain\Exceptions\InvalidSubscriptionDateException;
use App\src\MaSPack\Application\Exceptions\InvalidDateFormatException;

class SubscribeToSocialPackageCommandHandler
{
    private $socialPackageRepository;
    private $employeeRepository;
    
    public function __construct(SocialPackagesRepositoryInterface $socialPackageRepository, EmployeeRepositoryInterface $employeeRepository)
    {
        $this->socialPackageRepository = $socialPackageRepository;
        $this->employeeRepository = $employeeRepository;
    }

    public function handle(SubscribeToSocialPackageCommand $command)
    {
        $socialPackage = $this->socialPackageRepository->findOneById($command->idSocialPackage());
        $employee = $this->employeeRepository->findById($command->idEmployee());

        if (empty($socialPackage)) {
            throw new SocialPackageNotFoundException("Social package not found");
        }
        if (empty($employee)) {
            throw new EmployeeNotFoundException("Employee not found");
        }

        if ($this->isValidDate($command->startDate()) !== 1) {
            throw new InvalidDateFormatException("Start date isn't a correct date");
        }
        if ($this->isValidDate($command->endDate()) !== 1) {
            throw new InvalidDateFormatException("End date isn't a correct date");
        }

        if ($socialPackage->subscribe($command->startDate(), $command->endDate(), $command->amount())) {
            $this->socialPackageRepository->subscribeEmployeeToSocialPackage(
                $command->idSocialPackage(),
                $command->idEmployee(),
                $command->startDate(),
                $command->endDate(),
                $command->amount()
            );
        }
    }

    private function isValidDate(string $date): int
    {
        $pattern = '/\d{4}-\d{2}-\d{2}/';
        return preg_match($pattern, $date);
    }
}
