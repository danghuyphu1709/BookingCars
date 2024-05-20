<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\DepartureTimeInterface;
use App\Repositories\Interface\RoadRouteInterface;
use App\Repositories\Interface\TicketInterface;
use App\Repositories\Repository\DepartureTimeRepository;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    protected $roadRouteRepo;

    protected $departureTimeRepo;

    protected  $ticketRepo;

    public function __construct(TicketInterface $TicketInterface,RoadRouteInterface $RoadRouteInterface,DepartureTimeInterface $DepartureTimeInterface)
    {
        $this->roadRouteRepo = $RoadRouteInterface;
        $this->ticketRepo = $TicketInterface;
        $this->departureTimeRepo = $DepartureTimeInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = $this->ticketRepo->getAllTickets();
        $tickets = $this->ticketRepo->paginationQuery($query,8);
        return view('tickets.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roadRoute = $this->roadRouteRepo->getRoadRouteActive();
        $departureTime = $this->departureTimeRepo->getAllActive();
        return view('tickets.add',compact(['roadRoute','departureTime']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'departureTime' => 'required',
            'road_route' => 'required',
            'ticket_quantity' => 'required|integer|min:1',
        ]);

         if($this->ticketRepo->validatorCheck($request->input('departureTime'),$request->input('road_route'))){
             return redirect()->back()->withErrors(['errors_tickets'=>'Vé này đà trùng với vé tạo trước đó']);
         }
        $active = 0;
        if($request->input('active')){
            $active = $request->input('active');
        }

        $this->ticketRepo->create([
            'code' => $this->ticketRepo->code(),
            'departure_day_id' => $request->input('departureTime'),
            'road_route_id' => $request->input('road_route'),
            'ticket_quantity' => $request->input('ticket_quantity'),
            'status' => $active,
        ]);

        return redirect()->back()->withErrors(['success'=>'Thêm mới hạng vé thành công']);
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
        $ticket = $this->ticketRepo->find($id);
        $roadRoute = $this->roadRouteRepo->getRoadRouteActive();
        $departureTime = $this->departureTimeRepo->getAllActive();
        return view('tickets.edit',compact(['roadRoute','departureTime','ticket']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'departureTime' => 'required',
            'road_route' => 'required',
            'ticket_quantity' => 'required|integer|min:1',
        ]);

        $active = 0;
        if($request->input('active')){
            $active = $request->input('active');
        }

        $this->ticketRepo->update($id,[
            'code' => $this->ticketRepo->code(),
            'departure_day_id' => $request->input('departureTime'),
            'road_route_id' => $request->input('road_route'),
            'ticket_quantity' => $request->input('ticket_quantity'),
            'status' => $active,
        ]);

        return redirect()->back()->withErrors(['success'=>'Cập nhật mới hạng vé thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->ticketRepo->statusChange($id);
        return redirect()->back();
    }
}
