<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function paginationQuery($query,int $numberPage);

    public function pagination(int $numberPage);

    public function search(string $roles,string $keyword);

    public function all();

    public function code();
    public function getAllActive();

    public function find($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);
    public function statusChange($id,$status = 0);

}
