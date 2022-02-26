<?php

namespace App\Services\Implementations;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Support\Collection;

class UserService
{

    /**
     * @return Collection<User>
     */
    public function getActiveTeachers (): Collection
    {
        return User::where([["role", Roles::TEACHER], ["is_active", 1]])->get();
    }
}