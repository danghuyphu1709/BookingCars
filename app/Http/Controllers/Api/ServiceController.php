<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Interface\ServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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

    public function store(Request $request)
    {
            $validator  = Validator::make($request->all(),[
                'name' => 'required | min: 3| max: 25|unique:permissions,name',
                'images' => 'required|mimes:jpeg,png,webp,jpg|max:2048'
            ]);

            if($validator->fails()){
                $arr = [
                    'message' =>  'errors',
                    'status' => false,
                    'data' => $validator->errors()->toArray(),
                ];
                return response()->json($arr,200);
            }

            if($request->hasFile('images')){
                $fileImages = $request->file('images');
                $nameImages = $fileImages->getClientOriginalName();
                $path = $fileImages->storeAs('public/images'.'/',$nameImages);
            }
            $create = $this->serviceRepo->create([
                'name' => $request->input('name'),
                'image' => $nameImages,
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
                'images' => 'mimes:jpeg,png,webp,jpg|max:2048'
            ]);

            if($validator->fails()){
                $arr = [
                    'message' =>  'errors',
                    'status' => false,
                    'data' => $validator->errors()->toArray(),
                ];
                return response()->json($arr,200);
            }

            if($request->hasFile('images')){
                $fileImages = $request->file('images');
                $nameImages = $fileImages->getClientOriginalName();
                $path = $fileImages->storeAs('public/images'.'/',$nameImages);
                Storage::delete('public/images'.'/'.$request->input('imageOld'));
            }else{
                $nameImages = $request->input('imageOld');
            }
            $this->serviceRepo->update($id,[
                'name' => $request->input('name'),
                'image' => $nameImages,
                'status' => $request->input('active'),
            ]);
            $services = $this->serviceRepo->find($id,['id','name','image','status']);
            $arr = [
                'message' =>  'success',
                'status' => true,
                'data' => $services,
            ];
            return response()->json($arr,200);
        }
        $services = $this->serviceRepo->find($id,['id','name','image','status']);
        return response()->json($services,status: 200);
    }

}
