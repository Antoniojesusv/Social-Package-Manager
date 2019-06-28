<?php
namespace App\src\MaSPack\Application\Employee\Command;

class ImportEmployeesCommand
{
    private $filePath;
    private $fileExtension;

    public function __construct(string $filePath, string $fileExtension)
    {
        $this->filePath = $filePath;
        $this->fileExtension = $fileExtension;
    }

    public function filePath(): string
    {
        return $this->filePath;
    }

    public function fileExtension(): string
    {
        return $this->fileExtension;
    }
}
