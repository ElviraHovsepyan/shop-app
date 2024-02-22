<?php

namespace App\Repositories;


use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryRepository.
 */
class OrderRepository extends BasicRepository implements OrderRepositoryInterface
{

    protected Model $model;


    /**
     * CategoryRepository constructor.
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }


}
