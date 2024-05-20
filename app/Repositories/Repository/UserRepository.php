<?php

namespace App\Repositories\Repository;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\UserRepositoryInterface;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getCheckEmail($email){
        return $this->model->where('email', $email)->exists();
    }

    public function searchUsers(string $keyword)
    {
        $results = $this->model->where(function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
        })->get();
        return $results;
    }

    public function syncPermissions($role,$permission)
    {
        $role->syncPermissions($permission);
    }

    public function syncRoles($user,$roles)
    {
        $user->syncRoles($roles);
    }



}
