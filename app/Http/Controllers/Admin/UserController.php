<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\PermissionsInterface;
use App\Repositories\Interface\RoleInterface;
use \App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userRepository->pagination(10);
        return view('users.index',compact('users'));

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
