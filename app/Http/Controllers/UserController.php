<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->userRepository->getAllUsers()
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $userDetails = $request->only([
            'name',
            'email',
            'password',
            'role'
        ]);

        return response()->json(
            [
                'data' => $this->userRepository->createUser($userDetails)
            ],
            ResponseAlias::HTTP_CREATED
        );
    }




}
