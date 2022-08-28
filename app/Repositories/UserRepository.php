<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    protected User $userModel;
    protected Role $roleModel;

    public function __construct(User $userModel, Role $roleModel)
    {
        $this->userModel = $userModel;
        $this->roleModel = $roleModel;
    }

    public function findById(int $id): ?User
    {
        return $this->userModel->find($id);
    }

    public function findAll(): Collection
    {
        return $this->userModel->get();
    }

    public function create(array $attributes): User
    {
        return $this->userModel->create(attributes: $attributes);
    }

    public function update(int $id, array $attributes): ?User
    {
        $user = $this->findById(id: $id);

        if (empty($user)) {
            return null;
        }

        $user->fill(attributes: $attributes);
        $user->save();

        return $user;
    }

    public function delete(int $id): bool
    {
        $user = $this->findById(id: $id);

        if (empty($user)) {
            return false;
        }

        $user->delete();
        return true;
    }

    public function setRoles(int $id, array $roleNames): ?User
    {
        $user = $this->findById(id: $id);

        if (empty($user)) {
            return null;
        }

        $roleIds = $this->roleModel->select('id')->whereIn('name', $roleNames)->get()->map(fn ($r) => $r->id);
        if (empty($roleIds)) {
            return null;
        }

        $user->roles()->sync(ids: $roleIds);
        return $user->load(relations: [
            'roles'
        ]);
    }
}
