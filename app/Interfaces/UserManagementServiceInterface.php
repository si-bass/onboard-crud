<?php

namespace App\Interfaces;

use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserSetRolesRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

interface UserManagementServiceInterface
{
    public function storeUser(UserStoreRequest $request): array;
    public function updateUser(int $id, UserUpdateRequest $request): array;
    public function changePasswordUser(int $id, UserChangePasswordRequest $request): array;
    public function setRolesUser(int $id, UserSetRolesRequest $request): array;
    public function deleteUser(int $id): array;
    public function getUser(int $id): array;
    public function getUsers(): array;
}
