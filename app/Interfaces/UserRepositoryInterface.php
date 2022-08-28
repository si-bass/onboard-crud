<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function findById(int $id): ?Model;
    public function findAll(): Collection;
    public function create(array $attributes): Model;
    public function update(int $id, array $attributes): ?Model;
    public function setRoles(int $id, array $roleNames): ?Model;
    public function delete(int $id): bool;
}
