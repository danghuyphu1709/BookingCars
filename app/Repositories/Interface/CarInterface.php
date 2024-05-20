<?php

namespace App\Repositories\Interface;
use App\Repositories\BaseRepositoryInterface;
interface CarInterface extends BaseRepositoryInterface {
    public function getAllCars();
}
