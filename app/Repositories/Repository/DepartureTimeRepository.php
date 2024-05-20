<?php

namespace App\Repositories\Repository;
use App\Models\departure_day;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\DepartureTimeInterface;

class DepartureTimeRepository extends BaseRepository implements DepartureTimeInterface
{
    public function __construct(departure_day $departure_day)
    {
        parent::__construct($departure_day);
    }


}
