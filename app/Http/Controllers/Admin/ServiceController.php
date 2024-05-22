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
}
