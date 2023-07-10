<?php

namespace App\Repositories;


//use Your Model
use App\Models\FilterGroup;
use App\Repositories\Interfaces\FilterGroupRepositoryInterface;
use Illuminate\Database\Eloquent\Model;


class FilterGroupRepository extends BasicRepository implements FilterGroupRepositoryInterface
{
    protected Model $model;

    public function __construct(FilterGroup $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
}
