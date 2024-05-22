<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\TypeCarInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TypeCarController extends Controller
{
    protected $typeCarRepo;

    public function __construct(TypeCarInterface $typeCarInterface)
    {
        $this->typeCarRepo = $typeCarInterface;
    }

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

        $typecar = $this->typeCarRepo->searchCodeOrName($request->input('keyword'));

        $arr = [
            'status' => true,
            'message' => 'Lấy ra danh sách',
            'data' => $typecar,
            'timestamp' => Carbon::now()->toIso8601String()
        ];

        return response()->json($arr,status: 200);
    }


    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),[
            'name' => 'required | min: 3| max: 25|unique:permissions,name',
        ]);

        if($validator->fails()){
            $arr = [
                'message' =>  'errors',
                'status' => false,
                'data' => $validator->errors()->toArray(),
            ];
            return response()->json($arr,200);
        }

        $create = $this->typeCarRepo->create([
            'code' => $this->typeCarRepo->code(),
            'name' => $request->input('name'),
            'status' => $request->input('active'),
        ]);
        $arr = [
            'message' =>  'success',
            'status' => true,
            'data' => $create,
        ];
        return response()->json($arr,200);
    }

    public function update(string $id,Request $request)
    {
        if($request->isMethod('POST')){
            $validator  = Validator::make($request->all(),[
                'name' => 'required | min: 3| max: 25|unique:permissions,name',
            ]);

            if($validator->fails()){
                $arr = [
                    'message' =>  'errors',
                    'status' => false,
                    'data' => $validator->errors()->toArray(),
                ];
                return response()->json($arr,200);
            }
            $this->typeCarRepo->update($id,[
                'name' => $request->input('name'),
                'status' => $request->input('active'),
            ]);
            $update = $this->typeCarRepo->find($id,['id','name','status']);
            $arr = [
                'message' =>  'success',
                'status' => true,
                'data' => $update,
            ];
            return response()->json($arr,200);
        }
        $typecars = $this->typeCarRepo->find($id,['id','name','status']);
        return response()->json($typecars,status: 200);
    }
}
