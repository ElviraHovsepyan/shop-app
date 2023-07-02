<?php

namespace App\Repositories;


use App\Repositories\Interfaces\BasicRepositoryInterface;
use App\Traits\ListTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class BasicRepository implements BasicRepositoryInterface
{
    protected $model;

    use ListTrait;

    /**
     * BasicRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * @param int $id
     * @return Model
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * @return mixed
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }


    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        $this->model->where('id', $id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete(int $id)
    {
        $this->model->where('id', $id)->delete();
    }

}
