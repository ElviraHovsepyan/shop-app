<?php

namespace App\Repositories;


//use Your Model
use App\Models\Country;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;


class CountryRepository extends BasicRepository implements CountryRepositoryInterface
{
    protected Model $model;

    public function __construct(Country $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
}
