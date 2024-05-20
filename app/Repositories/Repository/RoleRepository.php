<?php

namespace App\Repositories\Repository;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\RoleInterface;
use App\Models\roles;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository implements RoleInterface
{
    public function __construct(roles $role)
    {
        parent::__construct($role);
    }

    public function findRoleSpatie($id)
    {
        return Role::find($id);
    }

    public function createRole(string $role)
    {
       return Role::create([
           'name' => $role
       ]);
    }

    public function getAllRoles($userId)
    {
        return $this->model
            ->select('roles.*', DB::raw("CASE WHEN model_has_roles.role_id IS NOT NULL THEN '1' ELSE '0' END AS status"))
            ->leftJoin('model_has_roles', function($join) use ($userId) {
                $join->on('roles.id', '=', 'model_has_roles.role_id')
                    ->where('model_has_roles.model_id', '=', $userId);
            })
            ->get();
    }

    public function getAllRoleArray()
    {
        return $this->model::pluck('id')->toArray();
    }

}
