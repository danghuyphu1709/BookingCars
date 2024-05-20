<?php

namespace App\Http\Controllers\Admin;
use App\Repositories\Interface\RoleInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class RoleController extends Controller
{
    protected $roleRepo;
    const SUPPER_ADMIN = 'supper admin';
    const MANAGE = 'manage';

    public function __construct(RoleInterface $roleRepo)
    {
         $this->roleRepo = $roleRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $roles = $this->roleRepo->pagination(10);
          return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required | min: 3| max: 25|unique:permissions,name',
        ]);

        if($this->roleRepo->createRole($request->input('role'))){
            return redirect()->back()->withErrors(['success'=>'Thêm vai trò mới thành công !']);
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
        $role = $this->roleRepo->find($id,['name','id']);
        return view('roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'role' => 'required | min: 3| max: 25|unique:permissions,name',
        ]);

        $this->roleRepo->update($id,[
            'name'=> $request->input('role')
        ]);

        return redirect()->back()->withErrors(['success'=>'Sửa vai trò thành công !']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,)
    {

    }
}
