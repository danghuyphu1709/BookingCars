<?php
namespace App\Repositories\Interface;
use App\Repositories\BaseRepositoryInterface;
interface TypeCarInterface extends BaseRepositoryInterface
{
    public function searchCodeOrName(string $keyword);

    public function getTypeCarActive();
}
