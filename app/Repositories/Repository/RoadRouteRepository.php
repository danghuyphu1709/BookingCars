<?php

namespace App\Repositories\Repository;
use App\Models\road_route;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\RoadRouteInterface;

class RoadRouteRepository extends BaseRepository implements RoadRouteInterface
{
    public function __construct(road_route $road_route)
    {
        parent::__construct($road_route);
    }


    public function starting_point(){
        return $this->model->select(
            'starting_areas.name as starting_name',
            'starting_areas.id as starting_id',
        )
            ->join('areas as starting_areas', 'starting_areas.id', '=', 'road_routes.starting_point_id')
            ->where('road_routes.status', '=',1)
            ->get();
    }
    public function destination_point(){
        return $this->model->select(
            'destination_areas.name as destination_name',
            'destination_areas.id as destination_id',
        )
            ->join('areas as destination_areas', 'destination_areas.id', '=', 'road_routes.destination_point_id')
            ->where('road_routes.status', '=',1)
            ->get();
    }

    public function getRoadRouteActive()
    {
        return $this->model->select(
            'road_routes.*',
            'starting_areas.name as starting_name',
            'destination_areas.name as destination_name',
            'cars.name as car_name',
            'cars.seats_quantity as quantity_max'
        )
            ->join('areas as starting_areas', 'starting_areas.id', '=', 'road_routes.starting_point_id')
            ->join('areas as destination_areas', 'destination_areas.id', '=', 'road_routes.destination_point_id')
            ->join('cars', 'cars.id', '=', 'road_routes.cars_id')
            ->where('road_routes.status', '=',1)
            ->get();
    }

    public function getAllRoadRoute(){
        $result = $this->model->select('road_routes.*', 'starting_areas.name as starting_name', 'destination_areas.name as destination_name', 'cars.name as car_name')
            ->join('areas as starting_areas', 'starting_areas.id', '=', 'road_routes.starting_point_id')
            ->join('areas as destination_areas', 'destination_areas.id', '=', 'road_routes.destination_point_id')
            ->join('cars','cars.id', '=', 'road_routes.cars_id');
        return $this->paginationQuery($result, 8);
    }

    public function searchRoute(string $keyword)
    {
        $result = $this->model->select(
            'road_routes.*',
            'starting_areas.name as starting_name',
            'destination_areas.name as destination_name',
            'cars.name as car_name'
        )
            ->join('areas as starting_areas', 'starting_areas.id', '=', 'road_routes.starting_point_id')
            ->join('areas as destination_areas', 'destination_areas.id', '=', 'road_routes.destination_point_id')
            ->join('cars', 'cars.id', '=', 'road_routes.cars_id')
            ->where('road_routes.code', 'like', '%' . $keyword . '%')
            ->get();

        return $result;
    }
}
