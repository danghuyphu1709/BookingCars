<?php

namespace App\Repositories\Repository;
use App\Models\Permissions;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\PermissionsInterface;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Permission;


class PermissionsRepository extends BaseRepository implements PermissionsInterface
{
    public function __construct(Permissions $permission)
    {
        parent::__construct($permission);
    }

    public function getAllPermissionArray()
    {
        return $this->model::pluck('id')->toArray();
    }

    public function findPermissionSpatie($id)
    {
        return Permission::find($id);
    }

     public function createPermission(string $permission)
     {
       return Permission::create([
           'name' => $permission
       ]);
     }

    public function getAllPermissions($roleId)
    {
        return $this->model
            ->select('permissions.*', DB::raw("CASE WHEN role_has_permissions.permission_id IS NOT NULL THEN '1' ELSE '0' END AS status"))
            ->leftJoin('role_has_permissions', function($join) use ($roleId) {
                $join->on('permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where('role_has_permissions.role_id', '=', $roleId);
            })
            ->get();
    }


}
