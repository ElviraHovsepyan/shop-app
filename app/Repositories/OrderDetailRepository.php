<?php

namespace App\Repositories;


use App\Models\OrderDetail;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryRepository.
 */
class OrderDetailRepository extends BasicRepository implements OrderDetailRepositoryInterface
{

    protected Model $model;


    /**
     * CategoryRepository constructor.
     * @param OrderDetail $model
     */
    public function __construct(OrderDetail $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }


}
