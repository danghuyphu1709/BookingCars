<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\RoadRouteInterface;
use Illuminate\Http\Request;
use App\Repositories\Interface\AreaInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class RoadRouteController extends Controller
{
   protected $areaRepo;

   protected $roadRouteRepo;
   public function __construct(AreaInterface $areaInterface,RoadRouteInterface $roadRouteInterface)
   {
       $this->areaRepo = $areaInterface;
       $this->roadRouteRepo = $roadRouteInterface;
   }


   public function getAddress(Request $request)
   {
       $validator = Validator::make($request->all(),[
           'id' => 'required',
       ]);

       if($validator ->fails()){
           $arr = [
               'status'=>false,
               'data'=>$validator->errors()->first(),
           ];
           return response()->json($arr,status:200);
       }
       $areas = $this->areaRepo->getCityProvince($request->input('id'));
       $arr = [
           'status' => true,
           'message' => 'Lấy ra danh sách',
           'data' => $areas,
           'timestamp' => Carbon::now()->toIso8601String()
       ];
       return response()->json($arr,status: 200);
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

        $roadRoute = $this->roadRouteRepo->searchRoute($request->input('keyword'));

        $arr = [
            'status' => true,
            'message' => 'Lấy ra danh sách',
            'data' => $roadRoute,
            'timestamp' => Carbon::now()->toIso8601String()
        ];

        return response()->json($arr,status: 200);
    }



}
