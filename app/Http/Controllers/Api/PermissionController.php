<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\PermissionsInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;



class PermissionController extends Controller
{


    public $permissionRepo;

    public function __construct( PermissionsInterface $permissions)
    {
        $this->permissionRepo = $permissions;
    }
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'keyword'=> 'required',
        ]);

        if($validator ->fails()){
            $arr = [
                'status'=>false,
                'data'=>$validator->errors()->first(),
            ];
            return response()->json($arr,status:200);
        }

        $permissions = $this->permissionRepo->search('name',$request->input('keyword'));

        $arr = [
            'status' => true,
            'message' => 'Lấy ra danh sách',
            'data' => $permissions,
            'timestamp' => Carbon::now()->toIso8601String()
        ];

        return response()->json($arr,status: 200);
    }

    public function index()
    {
        //
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
