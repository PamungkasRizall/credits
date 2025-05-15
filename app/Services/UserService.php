<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function findOrFail(string $id): User
    {
        return User::findOrFail($id);
    }

    public function storeUser(UserDTO $dto): User
    {
        return DB::transaction(function () use ($dto) {
            $user = User::updateOrCreate(
                ['id' => $dto->model_id],
                (array) $dto
            );

            $this->handleStoreRoles($user, $dto->roles);

            return $user;
        });
    }

    private function handleStoreRoles(User $user, array $roles): void
    {
        $user->assignRole(array_map('intval', $roles));
    }

    public function updateUser(UserDTO $dto): User
    {
        return DB::transaction(function () use ($dto) {
            return User::updateOrCreate(
                ['id' => $dto->model_id],
                (array) $dto
            );
        });
    }

    public function deleteUser(string $id): void
    {
        DB::transaction(function () use ($id) {
            $this->findOrFail($id)->delete();
        });
    }
}
