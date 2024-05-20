<?php
namespace App\Repositories\Interface;
use App\Repositories\BaseRepositoryInterface;

interface PermissionsInterface extends BaseRepositoryInterface
{
  public function findPermissionSpatie($id);

  public function getAllPermissions($roleId);

  public function createPermission(string $permission);

  public function getAllPermissionArray();
}
