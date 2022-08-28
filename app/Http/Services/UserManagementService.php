<?php

namespace App\Http\Services;

use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserSetRolesRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Response\HttpResponse;
use App\Interfaces\UserManagementServiceInterface;
use App\Interfaces\UserRepositoryInterface;

class UserManagementService implements UserManagementServiceInterface
{
    private UserRepositoryInterface $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function storeUser(UserStoreRequest $request): array
    {
        $user = $this->userRepo->create(attributes: $request->validated());
        return HttpResponse::created(data: $user->toArray());
    }

    public function updateUser(int $id, UserUpdateRequest $request): array
    {
        $user = $this->userRepo->update(id: $id, attributes: $request->except(keys: ['password', 'roles']));

        if (empty($user)) {
            return HttpResponse::notFound(message: 'User id ' . $id . ' not found');
        }

        return HttpResponse::ok(data: $user->toArray());
    }

    public function changePasswordUser(int $id, UserChangePasswordRequest $request): array
    {
        $user = $this->userRepo->update(id: $id, attributes: $request->only(keys: ['password']));

        if (empty($user)) {
            return HttpResponse::notFound(message: 'User id ' . $id . ' not found');
        }

        return HttpResponse::ok(data: $user->toArray());
    }

    public function setRolesUser(int $id, UserSetRolesRequest $request): array
    {
        $user = $this->userRepo->setRoles(id: $id, roleNames: $request->only(keys: 'roles'));

        if (empty($user)) {
            return HttpResponse::notFound(message: 'User or role not found');
        }

        return HttpResponse::ok(data: $user->toArray());
    }

    public function deleteUser(int $id): array
    {
        $isSuccess = $this->userRepo->delete(id: $id);

        if (!$isSuccess) {
            return HttpResponse::notFound(message: 'User id ' . $id . ' not found');
        }

        return HttpResponse::ok();
    }

    public function getUser(int $id): array
    {
        $user = $this->userRepo->findById(id: $id);

        if (empty($user)) {
            return HttpResponse::notFound(message: 'User id ' . $id . ' not found');
        }

        return HttpResponse::ok(data: $user->toArray());
    }

    public function getUsers(): array
    {
        return HttpResponse::ok(data: $this->userRepo->findAll()->toArray());
    }
}
