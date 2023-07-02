<?php

namespace App\Repositories;


//use Your Model
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductRepository.
 */
class ProductRepository extends BasicRepository implements ProductRepositoryInterface
{
    protected $model;

    /**
     * ProductRepository constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param $productId
     * @param $categoryId
     */
    public function attachCategory(int $productId, int $categoryId)
    {
        $this->find($productId)->categories()->attach($productId, ['category_id' => $categoryId]);
    }

    /**
     * @param $productId
     * @param $categoryIds
     */
    public function syncCategories(int $productId, array $categoryIds)
    {
        $this->find($productId)->categories()->sync($categoryIds);
    }


    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed|null
     */
    public function find(int $id): Model
    {
        return $this->model->with('categories')->find($id);
    }

}
