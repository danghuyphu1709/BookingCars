<?php

namespace App\Repositories\Repository;
use App\Models\tickets;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\TicketInterface;

class TicketRepository extends BaseRepository implements TicketInterface
{
    public function __construct(tickets $tickets)
    {
        parent::__construct($tickets);
    }

    public function getTimeRun(){
        return $this->model->select('tickets.id','departure_days.preparation_time')
                           ->join('departure_days', 'departure_days.id', '=', 'tickets.departure_day_id')
                           ->get();
    }


    public function getAllTickets(){

        return $this->model->select(
            'tickets.*',
            'starting_areas.name as starting_name',
            'destination_areas.name as destination_name',
            'cars.name as car_name',
            'departure_days.preparation_time',
            'departure_days.departure_time'
        )
            ->join('departure_days', 'departure_days.id', '=', 'tickets.departure_day_id')
            ->join('road_routes', 'road_routes.id', '=', 'tickets.road_route_id')
            ->join('areas as starting_areas', 'starting_areas.id', '=', 'road_routes.starting_point_id')
            ->join('areas as destination_areas', 'destination_areas.id', '=', 'road_routes.destination_point_id')
            ->join('cars', 'cars.id', '=', 'road_routes.cars_id');
    }

    public function getApiTickets(){

        return $this->model->select(
            'tickets.*',
            'starting_areas.name as starting_name',
            'destination_areas.name as destination_name',
            'cars.name as car_name',
            'road_routes.kilometer',
            'departure_days.departure_time'
        )
            ->join('departure_days', 'departure_days.id', '=', 'tickets.departure_day_id')
            ->join('road_routes', 'road_routes.id', '=', 'tickets.road_route_id')
            ->join('areas as starting_areas', 'starting_areas.id', '=', 'road_routes.starting_point_id')
            ->join('areas as destination_areas', 'destination_areas.id', '=', 'road_routes.destination_point_id')
            ->join('cars', 'cars.id', '=', 'road_routes.cars_id')
            ->get();
    }

    public function validatorCheck(string $departureTimeId,string $roadRouteId)
    {
        return $this->model->where('departure_day_id','=',$departureTimeId)
                           ->where('road_route_id', $roadRouteId)
                           ->first();
    }
}
