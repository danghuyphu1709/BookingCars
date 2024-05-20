<?php

namespace App\Http\Controllers\Admin;
use App\Repositories\Interface\PermissionsInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionRepo;
    /**
     * Display a listing of the resource.
     */

    public function __construct(PermissionsInterface $permissionRepo)
    {
          $this->permissionRepo = $permissionRepo;
    }

    public function index()
    {
        $permissions = $this->permissionRepo->pagination(8);
        return view('permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('permission.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'permission' => 'required | min: 3| max: 25|unique:permissions,name',
        ]);

        if($this->permissionRepo->createPermission($request->input('permission'))){
            return redirect()->back()->withErrors(['success'=>'Thêm quyền mới thành công !']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = $this->permissionRepo->find($id,['name','id']);
        return view('permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'permission' => 'required | min: 3| max: 25|unique:permissions,name',
        ]);

        $this->permissionRepo->update($id,[
            'name' => $request->input('permission')
        ]);

        return redirect()->back()->withErrors(['success'=>'Sửa phân quyền thành công !']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
