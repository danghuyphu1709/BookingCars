<?php
namespace App\Repositories\Repository;
use App\Models\city_province;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\CityProvinceInterface;


class CityProvinceRepository extends BaseRepository implements CityProvinceInterface
{
    public function __construct(city_province $city_province)
    {
        parent::__construct($city_province);
    }

}
