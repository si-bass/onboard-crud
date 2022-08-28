<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserSetRolesRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Interfaces\UserManagementServiceInterface;

class UserController extends Controller
{
    private UserManagementServiceInterface $userManageService;

    public function __construct(UserManagementServiceInterface $userManageService)
    {
        $this->userManageService = $userManageService;
    }

    public function store(UserStoreRequest $request)
    {
        $result = $this->userManageService->storeUser($request);
        return response()->toHttpCodeAndMap($result);
    }

    public function update(int $id, UserUpdateRequest $request)
    {
        $result = $this->userManageService->updateUser(id: $id, request: $request);
        return response()->toHttpCodeAndMap($result);
    }

    public function updatePassword(int $id, UserChangePasswordRequest $request)
    {
        $result = $this->userManageService->changePasswordUser(id: $id, request: $request);
        return response()->toHttpCodeAndMap($result);
    }

    public function updateRoles(int $id, UserSetRolesRequest $request)
    {
        $result = $this->userManageService->setRolesUser(id: $id, request: $request);
        return response()->toHttpCodeAndMap($result);
    }

    public function delete(int $id)
    {
        $result = $this->userManageService->deleteUser(id: $id);
        return response()->toHttpCodeAndMap($result);
    }

    public function detail(int $id)
    {
        $result = $this->userManageService->getUser(id: $id);
        return response()->toHttpCodeAndMap($result);
    }

    public function list()
    {
        $result = $this->userManageService->getUsers();
        return response()->toHttpCodeAndMap($result);
    }
}
