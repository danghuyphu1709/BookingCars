<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interface\TypeCarInterface;

class TypeCarController extends Controller
{
     protected  $typeCarRepo;

    public function __construct(TypeCarInterface $typeCarInterface)
    {
        $this->typeCarRepo = $typeCarInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $typeCar = $this->typeCarRepo->pagination(8);
         return view('typecar.index',compact('typeCar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('typecar.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | min: 3| max: 25|unique:permissions,name',
        ]);
        $active = 0;
        if($request->input('active')){
            $active = $request->input('active');
        }
        $code = $this->typeCarRepo->code();

        $this->typeCarRepo->create([
            'code' => $code,
            'name' => $request->input('name'),
            'status' => $active,
        ]);
        return redirect()->back()->withErrors(['success'=>'Thêm loại xe thành công !']);
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
        $typeCar = $this->typeCarRepo->find($id);
        return view('typecar.edit',compact('typeCar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required | min: 3| max: 25|unique:permissions,name',
        ]);
        $active = 0;
        if($request->input('active')){
            $active = $request->input('active');
        }
        $this->typeCarRepo->update($id,[
            'name' => $request->input('name'),
            'status' => $active,
        ]);
        return redirect()->back()->withErrors(['success'=>'Cập nhật loại xe thành công !']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->typeCarRepo->statusChange($id);
        return redirect()->back();
    }
}
