<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interface\ServiceInterface;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    protected $serviceRepo;
    public function __construct(ServiceInterface $ServiceInterface)
    {
        $this->serviceRepo = $ServiceInterface;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = $this->serviceRepo->pagination(8);
        return view('services.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | min: 3| max: 25|unique:permissions,name',
            'images' => 'required|mimes:jpeg,png,webp|max:2048'
        ]);

        if($request->hasFile('images')){
            $fileImages = $request->file('images');
            $nameImages = $fileImages->getClientOriginalName();
            $path = $fileImages->storeAs('public/images'.'/',$nameImages);
        }
          $active = 0;
        if($request->input('active')){
          $active = $request->input('active');
        }

        $this->serviceRepo->create([
            'name' => $request->input('name'),
            'image' => $nameImages,
            'status' => $active,
        ]);

        return redirect()->back()->withErrors(['success'=>'Thêm Dịch Vụ Thành Công !']);

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
        $service = $this->serviceRepo->find($id);
        return view('services.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required | min: 3| max: 25|unique:permissions,name',
            'images' => 'mimes:jpeg,png,webp|max:2048'
        ]);

        if($request->hasFile('images')){
            $fileImages = $request->file('images');
            $nameImages = $fileImages->getClientOriginalName();
            $path = $fileImages->storeAs('public/images'.'/',$nameImages);
            Storage::delete('public/images'.'/'.$request->input('image_old'));
        }else{
            $nameImages = $request->input('image_old');
        }
        $active = 0;
        if($request->input('active')){
            $active = $request->input('active');
        }
        $this->serviceRepo->update($id,[
            'name' => $request->input('name'),
            'image' => $nameImages,
            'status' => $active,
        ]);

        return redirect()->back()->withErrors(['success'=>'Cập nhật dịch vụ thành công !']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->serviceRepo->statusChange($id);
        return redirect()->back();
    }
}
