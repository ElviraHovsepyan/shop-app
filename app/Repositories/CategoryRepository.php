<?php

namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BasicRepository implements CategoryRepositoryInterface
{

    protected $model;

    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getAll(): Collection
    {
        return $this->model->with('parent')->get();
    }

    /**
     * @return Collection
     */
    public function getCategoriesTree(): Collection
    {
        return $this->model->whereNull('parent_id')
            ->with('childrenCategories')
            ->get();
    }

}
