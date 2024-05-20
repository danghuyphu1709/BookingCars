<?php
namespace App\Repositories\Repository;
use App\Models\cars;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\CarInterface;


class CarRepository extends BaseRepository implements CarInterface
{
    public function __construct(cars $cars)
    {
        parent::__construct($cars);
    }

     public function getAllCars(){
         $result = $this->model->select('cars.*','services.name as service_name', 'type_cars.name as type_car_name')
             ->join('services', 'cars.service_id', '=', 'services.id')
             ->join('type_cars', 'cars.type_car_id', '=', 'type_cars.id');
         return $this->paginationQuery($result,8);
     }

}
