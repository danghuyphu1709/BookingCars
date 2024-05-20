<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\PermissionsInterface;
use App\Repositories\Interface\RoleInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    protected $userRepository;

    protected $permissionRepo;

    protected $roleRepo;

    public function __construct(UserRepositoryInterface $userRepository,PermissionsInterface $permissionRepo,RoleInterface $roleRepo)
    {
        $this->userRepository = $userRepository;
        $this->permissionRepo = $permissionRepo;
        $this->roleRepo = $roleRepo;
    }


    public function applyRoles(Request $request,string $id)
    {
        if($request->isMethod('POST')){
            if($request->input('permissions')){
                $role = $this->roleRepo->findRoleSpatie($id);
                $values = array_map('intval', $request->input('permissions'));
                $this->userRepository->syncPermissions($role,$values);
            }else{
                return redirect()->back()->withErrors(['permissions'=>'Vui lòng chọn ít nhất 1 quyền']);
            }
            return redirect()->back()->withErrors(['success'=>'Phân quyền ̀ thành công !']);
        }
        $permissions = $this->permissionRepo->getAllPermissions($id);
        return view('roles.apply',compact(['permissions','id']));
    }


    public function applyUsers(Request $request , string $id)
    {
      if($request->isMethod('POST')){
         $user = $this->userRepository->find($id);

         if($request->input('role')){
             $values = array_map('intval',  $request->input('role'));
             $this->userRepository->syncRoles($user,$values);
         }else{
             return redirect()->back()->withErrors(['role'=>'Vui lòng chọn ít nhất 1 quyền']);
         }
          return redirect()->back()->withErrors(['success'=>'Gán quyền thành công !']);
      }
        $roles = $this->roleRepo->getAllRoles($id);

        return view('users.apply',compact(['roles','id']));
    }
}
