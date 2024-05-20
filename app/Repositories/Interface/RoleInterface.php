<?php
namespace App\Repositories\Interface;
use App\Repositories\BaseRepositoryInterface;

interface RoleInterface extends BaseRepositoryInterface
{
    public function findRoleSpatie($id);

    public function getAllRoleArray();

    public function createRole(string $role);

    public function getAllRoles($userId);
}
