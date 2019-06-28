<?php
namespace App\src\MaSPack\Application\FileReader;

interface FileReaderInterface
{
    public function readToArray(string $filePath, string $fileExtension) : array;
}
