<?php

namespace App\Repositories;

use App\Repositories\FileRepositoryInterface;
use App\Models\File;

class FileRepository implements FileRepositoryInterface
{
    private $model;

    public function __construct(FileEvent $model)
    {
        $this->model = $model;
    }


    public function all()
    {
        return File::all();
    }

    public function findById($id)
    {
        return File::findOrFail($id);
    }

    public function create($data)
    {
        return File::create($data);
    }

    public function update($data, $id)
    {
        $file = File::findOrFail($id);
        $file->update($data);
        return $file;
    }

    public function delete($id)
    {
        File::destroy($id);
    }

    public function setActive($active, $id)
    {
        $file = File::findOrFail($id);
        $file->is_active = (bool)$active;
        $file->save();
        return $file;
    }

    public function setReserved($reserved, $id)
    {
        $file = File::findOrFail($id);
        $file->is_reserved = (bool)$reserved;
        $file->save();
        return $file;
    }

    public function reserveFiles(array $fileIds): bool
    {
        try {
            DB::transaction(function () use ($fileIds) {
                // Check if any of the files have events for the current user
                $existingEvents = $this->model->whereIn('file_id', $fileIds)
                    ->where('user_id', auth()->id())
                    ->get();

                if (!empty($existingEvents)) {
                    throw new \Exception('Some files are already reserved by another user.');
                }

                // If no events exist, create new ones for all files
                $reservedCount = $this->model->whereIn('file_id', $fileIds)->update([
                    'user_id' => auth()->id(),
                    'date' => now()->toDateString(),
                    'details' => null,
                ]);

                if ($reservedCount !== count($fileIds)) {
                    throw new \Exception('Failed to reserve all files.');
                }
            });

            return true;
        } catch (\Exception $e) {
            \Log::error('Error reserving files: ' . $e->getMessage());
            return false;
        }
    }
}
