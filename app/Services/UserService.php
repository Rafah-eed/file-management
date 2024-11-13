<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    // public function createUser(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'role' => $data['role']
    //     ]);
    // }

    // public function validateCredentials(array $credentials): bool
    // {
    //     return Auth::attempt($credentials);
    // }

    // public function getUserByCredentials(array $credentials): ?\Illuminate\Contracts\Auth\Authenticatable
    // {
    //     return Auth::guard('api')->getProvider()->retrieveByCredentials($credentials);
    // }
}
