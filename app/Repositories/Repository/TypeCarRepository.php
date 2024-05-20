<?php
namespace App\Repositories\Repository;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\TypeCarInterface;
use App\Models\type_car;

class TypeCarRepository extends BaseRepository implements TypeCarInterface
{
    public function __construct(type_car $type_car)
    {
        parent::__construct($type_car);
    }
    public function searchCodeOrName(string $keyword){
            $results = $this->model->where(function ($query) use ($keyword) {
                $query->where('code', 'like', '%' . $keyword . '%')
                    ->orWhere('name', 'like', '%' . $keyword . '%');
            })->get();
            return $results;
    }
    public function getTypeCarActive(){

        return $this->model->where('status', '=', 1)->get();

    }
}
