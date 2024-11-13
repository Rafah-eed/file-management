<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    private FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    // ... other methods ...

    public function setActive(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'active' => 'required|boolean'
        ]);

        $updatedFile = $this->fileService->setActive($validatedData['active'], $id);

        return response()->json($updatedFile);
    }

    public function setReserved(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'reserved' => 'required|boolean'
        ]);

        $updatedFile = $this->fileService->setReserved($validatedData['reserved'], $id);

        return response()->json($updatedFile);
    }
}
