<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\DepartureTimeInterface;
use Illuminate\Http\Request;

class DepartureTimeController extends Controller
{
  protected  $DepartureTimeRepo;

    public function __construct(DepartureTimeInterface $DepartureTimeInterFace )
    {
        $this->DepartureTimeRepo = $DepartureTimeInterFace;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departureTime = $this->DepartureTimeRepo->pagination(8);
        return view('departureTime.index',compact('departureTime'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departureTime.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'preparation_time' => 'required|date_format:H:i',
            'departure_time' => 'required|date_format:H:i|after:preparation_time|before:preparation_time +2 hours',
        ], [
            'departure_time.after' => 'Thời gian khởi hành phải sau thời gian chuẩn bị.',
            'departure_time.before' => 'Thời gian khởi hành không được quá 2 giờ sau thời gian chuẩn bị.',
        ]);

        $active = 0;
        if($request->input('active')){
            $active = $request->input('active');
        }

        $this->DepartureTimeRepo->create([
            'code' => $this->DepartureTimeRepo->code(),
            'preparation_time' => $request->input('preparation_time'),
            'departure_time' => $request->input('departure_time'),
            'status' => $active
        ]);

        return redirect()->back()->withErrors(['success'=>'Thêm thời gian mới thành công']);
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
        $departureTime = $this->DepartureTimeRepo->find($id);
        return view('departureTime.edit',compact('departureTime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'preparation_time' => 'required|date_format:H:i',
            'departure_time' => 'required|date_format:H:i|after:preparation_time|before:preparation_time +2 hours',
        ], [
            'departure_time.after' => 'Thời gian khởi hành phải sau thời gian chuẩn bị.',
            'departure_time.before' => 'Thời gian khởi hành không được quá 2 giờ sau thời gian chuẩn bị.',
        ]);

        $active = 0;
        if($request->input('active')){
            $active = $request->input('active');
        }

        $this->DepartureTimeRepo->update($id,[
            'code' => $this->DepartureTimeRepo->code(),
            'preparation_time' => $request->input('preparation_time'),
            'departure_time' => $request->input('departure_time'),
            'status' => $active
        ]);

        return redirect()->back()->withErrors(['success'=>' Cập nhật thời gian mới thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->DepartureTimeRepo->statusChange($id);
        return redirect()->back();
    }
}
