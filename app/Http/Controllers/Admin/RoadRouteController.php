<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interface\CityProvinceInterface;
use App\Repositories\Interface\CarInterface;
use App\Repositories\Interface\RoadRouteInterface;


class RoadRouteController extends Controller
{
     protected $cityProvinceRepo;
     protected $carRepo;
     protected $roadRouteRepo;
     public function __construct(RoadRouteInterface $roadRouteInterface,CityProvinceInterface $cityProvinceInterface,CarInterface $carInterface)
     {
         $this->cityProvinceRepo = $cityProvinceInterface;
         $this->carRepo = $carInterface;
         $this->roadRouteRepo = $roadRouteInterface;
     }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roadRoute = $this->roadRouteRepo->getAllRoadRoute();
        return view('roadRoute.index',compact('roadRoute'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $city = $this->cityProvinceRepo->all();
        $cars = $this->carRepo->getAllActive();
        return view('roadRoute.add',compact(['city','cars']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Starting' => 'required',
            'Destination' => 'required',
            'kilometer' => 'required|numeric|min:20'
        ]);
        if($request->input('Starting') == $request->input('Destination')){
            return redirect()->back()->withErrors(['errors_road'=>'Điểm xuất phát không được trùng với điểm đến']);
        }
        $active = 0;
        if($request->input('active')){
            $active = $request->input('active');
        }
        $this->roadRouteRepo->create([
            'code' => $this->roadRouteRepo->code(),
            'starting_point_id' => $request->input('Starting'),
            'destination_point_id' => $request->input('Destination'),
            'cars_id' => $request->input('car_id'),
            'kilometer' => $request->input('kilometer'),
            'status' => $active
        ]);

        return redirect()->back()->withErrors(['success'=>'Thêm tuyến đường mới thành công']);
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
        $roadRoute = $this->roadRouteRepo->find($id);
        $city = $this->cityProvinceRepo->all();
        $cars = $this->carRepo->getAllActive();
        return view('roadRoute.edit',compact(['city','cars','roadRoute']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Starting' => 'required',
            'Destination' => 'required',
            'kilometer' => 'required|numeric|min:20'
        ]);
        if($request->input('Starting') == $request->input('Destination')){
            return redirect()->back()->withErrors(['errors_road'=>'Điểm xuất phát không được trùng với điểm đến']);
        }

        $active = 0;
        if($request->input('active')){
            $active = $request->input('active');
        }

        $this->roadRouteRepo->update($id,[
            'starting_point_id' => $request->input('Starting'),
            'destination_point_id' => $request->input('Destination'),
            'cars_id' => $request->input('car_id'),
            'kilometer' => $request->input('kilometer'),
            'status' => $active
        ]);

        return redirect()->back()->withErrors(['success'=>' Cập nhật tuyến đường mới thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->roadRouteRepo->statusChange($id);
        return redirect()->back();
    }
}
