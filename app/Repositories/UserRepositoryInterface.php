<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function createUser(array $data);
    public function findByEmail(string $email);
}

class EloquentUserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }
}
