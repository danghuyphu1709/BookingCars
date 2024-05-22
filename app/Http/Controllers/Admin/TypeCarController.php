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
}
