<?php

namespace App\Repositories;


use App\Models\Basket;
use App\Repositories\Interfaces\BasketRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryRepository.
 */
class BasketRepository extends BasicRepository implements BasketRepositoryInterface
{

    protected Model $model;


    /**
     * CategoryRepository constructor.
     * @param Basket $model
     */
    public function __construct(Basket $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function syncProducts($data): mixed
    {
        $item = $this->model->where(['product_id' => $data['product_id'], 'user_id' => $data['user_id']])->first();
        if (!$item) {
            $this->model->create($data);
        } else {
            $data['count'] += $item->count;
            $item->update($data);
        }
        return $item;
    }

    public function deleteOne($id)
    {
        $item = $this->model->find($id);
        $item->count = $item->count - 1;
        $item->save();
        return $item;
    }


}
