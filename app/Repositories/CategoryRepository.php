<?php

namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BasicRepository implements CategoryRepositoryInterface
{

    protected \Illuminate\Database\Eloquent\Model $model;

    protected $fields = ['name'];

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
     * @return Collection
     */
    public function getCategoriesTree(): Collection
    {
        return $this->model->whereNull('parent_id')
            ->with('childrenCategories')
            ->get();
    }

}
