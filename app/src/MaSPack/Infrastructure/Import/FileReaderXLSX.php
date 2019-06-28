<?php
namespace App\src\MaSPack\Infrastructure\Import;

use App\src\MaSPack\Application\FileReader\FileReaderInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\src\MaSPack\Infrastructure\Import\EmployeeImport;
use App\src\MaSPack\Infrastructure\Exceptions\ImportFileNotSupportedException;
use Illuminate\Http\UploadedFile;

class FileReaderXLSX  implements FileReaderInterface
{
    public function readToArray(string $filePath, string $fileExtension): array
    {
        $rawArray = Excel::toArray(new EmployeeImport(), new UploadedFile($filePath, "importingFile.".$fileExtension));

        return $rawArray;
    }
}
