<?php

namespace App\Repositories\Interfaces;



use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BasicRepositoryInterface
{

    /**
     * @param int $id
     * @return Model
     */
    public function find(int $id);

    /**
     * @param $data
     * @return mixed
     */
    public function create(array $data): Model;

    /**
     * @return mixed
     */
    public function getAll(): Collection;

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update(array $data, int $id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete(int $id);

}
