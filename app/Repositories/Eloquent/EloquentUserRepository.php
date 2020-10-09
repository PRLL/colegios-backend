<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepository;

class EloquentUserRepository implements UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user->all();
    }

    public function create(array $attributes)
    {
        $attributes['code'] = $this->generateCode(6);
        return $this->user->create($attributes);
    }

    public function update(array $attributes, User $user)
    {
        return $user->update($attributes);
    }

    private function generateCode($length = 20)
    {
        $characters = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}