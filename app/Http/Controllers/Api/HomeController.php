<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\RoadRouteInterface;
use App\Repositories\Interface\TicketInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    protected $ticketRepo;

    protected  $roadRoute;

    public function __construct(TicketInterface $ticketInterface,RoadRouteInterface $roadRoute)
    {
         $this->ticketRepo = $ticketInterface;
         $this->roadRoute = $roadRoute;
    }
    public function index()
    {
        $tickets = $this->ticketRepo->getApiTickets();
        $destination_point = $this->roadRoute->destination_point();
        $starting_point = $this->roadRoute->starting_point();
        $arr = [
            'status' => true,
            'message' => 'Lấy ra danh sách',
            'data' => $tickets,
            'destination_point' => $destination_point,
            'starting_point' => $starting_point,
        ];
         return response()->json($arr,status: 200);
    }
}
