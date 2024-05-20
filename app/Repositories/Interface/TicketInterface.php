<?php
namespace App\Repositories\Interface;

use App\Repositories\BaseRepositoryInterface;

interface TicketInterface extends BaseRepositoryInterface
{
   public function getTimeRun();
    public function getAllTickets();

    public function  getApiTickets();
   public function validatorCheck(string $departureTimeId,string $roadRouteId);
}
