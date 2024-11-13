<?php

namespace App\Services;
use App\Repositories\FileRepositoryInterface;

class FileService
{
    private FileRepositoryInterface $fileRepository;

    public function __construct(FileRepositoryInterface $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    // ... other methods ...

    public function setActive($active, $id)
    {
        return $this->fileRepository->setActive($active, $id);
    }

    public function setReserved($reserved, $id)
    {
        return $this->fileRepository->setReserved($reserved, $id);
    }

    public function reserveFiles(array $fileIds): bool
    {
        return $this->fileRepository->reserveFiles($fileIds);
    }
}
