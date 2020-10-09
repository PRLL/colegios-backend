<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepository
{
    public function index();
    public function create(array $attributes);
    public function update(array $attributes, User $user);
}