<?php
namespace App\Repositories\Repository;
use App\Models\area;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\AreaInterface;

class AreaRepository extends BaseRepository implements AreaInterface
{
    public function __construct(area $area)
    {
        parent::__construct($area);
    }

    public function getCityProvince(string $id)
    {   $result = $this->model->select('areas.name','areas.id')
        ->join('city_provinces', 'city_provinces.id', '=', 'areas.city_province_id')
        ->where('areas.city_province_id','=',$id)->get();
        return $result;

    }

}
