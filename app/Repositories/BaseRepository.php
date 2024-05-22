<?php
// app/Repositories/BaseRepository.php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function pagination(int $numberPage)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($numberPage);
    }
    public function paginationQuery($query,int $numberPage)
    {
        return $query->paginate($numberPage);
    }

    public function search(string $roles,string $keyword)
    {
        $results = $this->model->where($roles, 'like', '%' . $keyword. '%')
        ->get();
        return $results;
    }

    public function code()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(1000, 9999)
            . mt_rand(1000, 9999)
            . $characters[rand(0, strlen($characters) - 1)];
        $string = str_shuffle($pin);
        $check = $this->model->where('code', '=', $string)->first();
        if(!$check){
            return $string;
        }else{
            return null;
        }
    }

    public function getAllActive(){

        return $this->model->where('status', '=', 1)->get();

    }


    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function find($id,$columns = ['*'])
    {
        if (!is_numeric($id) || $id <= 0) {
            return null;
        }
        try {
            return $this->model->findOrFail($id, $columns);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $record = $this->find($id);
        if ($record) {
            $record->update($attributes);
            return $record;
        }

        return null;
    }

    public function delete($id)
    {
        $record = $this->find($id);
        if ($record) {
            $record->delete();
            return true;
        }

        return false;
    }

    public function statusChange($id,$status = 0)
    {
        $record = $this->find($id);
        if ($record) {
            $record->update(['status' => $status]);
            return true;
        }

        return false;
    }
}

