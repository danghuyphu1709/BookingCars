<?php
namespace App\Repositories\Repository;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\ServiceInterface;
use App\Models\services;

class ServiceRepository extends BaseRepository implements ServiceInterface
{
    public function __construct(services $services)
    {
        parent::__construct($services);
    }

}
