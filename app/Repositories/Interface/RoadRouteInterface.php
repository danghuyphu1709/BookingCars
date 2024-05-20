<?php
namespace App\Repositories\Interface;

use App\Repositories\BaseRepositoryInterface;

interface RoadRouteInterface extends BaseRepositoryInterface
{
     public function starting_point();
     public function destination_point();
     public function getAllRoadRoute();

     public function searchRoute(string $keyword);

    public function getRoadRouteActive();

}
