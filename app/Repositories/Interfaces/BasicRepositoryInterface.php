<?php

namespace App\Repositories\Interfaces;



use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BasicRepositoryInterface
{

    /**
     * @param int $id
     * @param array $relations
     * @return Model
     */
    public function find(int $id, array $relations = []): Model;

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): Model;

    /**
     * @return mixed
     */
    public function getAll(): Collection;


    /**
     * @param array $data
     * @param int $id
     * @return Model
     */
    public function update(array $data, int $id): Model;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;

}
