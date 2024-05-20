<?php
namespace App\Repositories\Interface;
use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getCheckEmail($email);

    public function syncPermissions($role,$permission);
    public function syncRoles($user,$roles);

    public function searchUsers(string $keyword);


}
