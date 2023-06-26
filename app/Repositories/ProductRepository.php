<?php

namespace App\Repositories;


//use Your Model
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

/**
 * Class CategoryRepository.
 */
class ProductRepository extends BasicRepository implements ProductRepositoryInterface
{
    private $model;

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
    public function attachCategory($productId, $categoryId)
    {
//        $product = $this->find($productId);
//        $exists = $product->categories->contains($categoryId);

//        $attached = $this->find($productId)->whereHas( 'categories', function ($query) use ($categoryId){
//           $query->where('category_id', $categoryId);
//        })->first();

        $this->find($productId)->categories()->attach($productId, ['category_id' => $categoryId]);
    }

    /**
     * @param $productId
     * @param $categoryIds
     */
    public function syncCategories($productId, $categoryIds)
    {
        $this->find($productId)->categories()->sync($categoryIds);
    }


    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed|null
     */
    public function find($id)
    {
        return $this->model->with('categories')->find($id);
    }

}
