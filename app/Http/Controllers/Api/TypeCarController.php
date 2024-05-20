<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\TypeCarInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
}
