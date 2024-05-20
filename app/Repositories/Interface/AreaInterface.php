<?php
namespace App\Repositories\Interface;

use App\Repositories\BaseRepositoryInterface;

interface AreaInterface extends BaseRepositoryInterface
{

    public function getCityProvince(string $id);

}
