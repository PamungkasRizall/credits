<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function all(): Collection
    {
        return Role::pluck('name', 'id');
    }
}
