<?php

namespace App\Http\Controllers\Api;
use App\Repositories\Interface\ServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{

    protected $serviceRepo;

    public function __construct(ServiceInterface $serviceInterface)
    {
        $this->serviceRepo = $serviceInterface;
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

        $services = $this->serviceRepo->search('name',$request->input('keyword'));

        $arr = [
            'status' => true,
            'message' => 'Lấy ra danh sách',
            'data' => $services,
            'timestamp' => Carbon::now()->toIso8601String()
        ];

        return response()->json($arr,status: 200);
    }
}
