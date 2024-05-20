<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interface\ServiceInterface;
use App\Repositories\Interface\TypeCarInterface;
use App\Repositories\Interface\CarInterface;
class CarController extends Controller
{
    protected $serviceRepo;
    protected $typeCarRepo;
    protected $CarRepo;
    public function __construct(ServiceInterface $ServiceInterface,TypeCarInterface $TypeCarInterface,CarInterface $CarInterface)
    {
      $this->serviceRepo = $ServiceInterface;
      $this->typeCarRepo = $TypeCarInterface;
      $this->CarRepo = $CarInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = $this->CarRepo->getAllCars();
        return view('cars.index',compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $services = $this->serviceRepo->getAllActive();
        $typeCar = $this->typeCarRepo->getAllActive();
        return view('cars.add',compact(['services','typeCar']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:25|min:3',
            'seat_price' => 'required|numeric|min:100|max:99000',
            'seat_quantity' => 'required|integer|min:6|max:70',
            'service' => 'required|exists:services,id',
            'typeCar' => 'required|exists:type_cars,id'
        ]);
        $active = 0;
        if($request->input('active')){
            $active = $request->input('active');
        }
        $this->CarRepo->create([
            'service_id' => $request->input('service'),
            'type_car_id' => $request->input('typeCar'),
            'code' => $this->CarRepo->code(),
            'name' => $request->input('name'),
            'seats_price' => $request->input('seat_price'),
            'seats_quantity' => $request->input('seat_quantity'),
            'status' => $active
        ]);
        return redirect()->back()->withErrors(['success'=>'Thêm mới xe thành công !']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {



    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = $this->CarRepo->find($id);
        $services = $this->serviceRepo->getAllActive();
        $typeCar = $this->typeCarRepo->getAllActive();
        return view('cars.edit',compact(['car','services','typeCar']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:25|min:3',
            'seat_price' => 'required|numeric|min:100|max:99000',
            'seat_quantity' => 'required|integer|min:6|max:70',
            'service' => 'required|exists:services,id',
            'typeCar' => 'required|exists:type_cars,id'
        ]);
        $active = 0;
        if($request->input('active')){
            $active = $request->input('active');
        }
        $this->CarRepo->update($id,[
            'service_id' => $request->input('service'),
            'type_car_id' => $request->input('typeCar'),
            'code' => $this->CarRepo->code(),
            'name' => $request->input('name'),
            'seats_price' => $request->input('seat_price'),
            'seats_quantity' => $request->input('seat_quantity'),
            'status' => $active
        ]);
        return redirect()->back()->withErrors(['success'=>'Cập nhật mới xe thành công !']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->CarRepo->statusChange($id);
        return redirect()->back();
    }
}
