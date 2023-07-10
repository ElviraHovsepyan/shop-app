<?php

namespace App\Repositories;


use App\Repositories\Interfaces\BasicRepositoryInterface;
use App\Traits\ListTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class BasicRepository implements BasicRepositoryInterface
{
    protected Model $model;

    protected $fields;

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
     * @param array $relations
     * @return Model
     */
    public function find(int $id, array $relations = []): Model
    {
        return $this->model->with($relations)->find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }


    /**
     * @param array $relations
     * @return Collection
     */
    public function getAll(array $relations = []): Collection
    {
        return $this->model->with($relations)->get();
    }


    /**
     * @param array $data
     * @param int $id
     * @return Model
     */
    public function update(array $data, int $id): Model
    {
        return  tap($this->model, function () use ($id, $data) {
            $this->model->where('id', $id)->update($data);
        });
    }


    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->model->where('id', $id)->delete();
    }

}
