<?php

namespace App\Repositories;


//use Your Model
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductRepository.
 */
class ProductRepository extends BasicRepository implements ProductRepositoryInterface
{
    protected Model $model;
    protected $fields = ['name', 'description'];

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
     * @param int $productId
     * @param array $categoryIds
     */
    public function syncCategories(int $productId, array $categoryIds): void
    {
        $this->find($productId)->categories()->sync($categoryIds);
    }

    /**
     * @param int $productId
     * @param array $filterIds
     * @return void
     */
    public function syncFilters(int $productId, array $filterIds): void
    {
        $this->find($productId)->filters()->sync($filterIds);
    }

    /**
     * @param $user_id
     * @return Collection
     */
    public function getBasketItems($user_id): Collection
    {
        return $this->model->with(['basket' => function ($query) use ($user_id){
            $query->where('user_id', $user_id);
        }])
            ->whereHas('basket', function ($query) use ($user_id){
            $query->where('user_id', $user_id);
        })->get();
    }

}
