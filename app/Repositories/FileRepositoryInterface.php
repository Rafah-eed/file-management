<?php

namespace App\Repositories;

interface FileRepositoryInterface
{
    public function all();
    public function findById($id);
    public function create($data);
    public function update($data, $id);
    public function delete($id);
    public function setActive($active, $id);
    public function setReserved($reserved, $id);
    public function reserveFiles(array $fileIds): bool;
}

