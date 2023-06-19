<?php

namespace App\Repositories;


use App\Repositories\Interfaces\BasicRepositoryInterface;
use Illuminate\Database\Eloquent\Model;


class BasicRepository implements BasicRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }


    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->model->where('id', $id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

}
