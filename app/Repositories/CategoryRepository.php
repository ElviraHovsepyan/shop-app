<?php

namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BasicRepository implements CategoryRepositoryInterface
{

    private $category;

    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        parent::__construct($category);
        $this->category = $category;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getAll()
    {
        return $this->category->with('parent')->get();
    }

    /**
     * @return mixed
     */
    public function getCategoriesTree()
    {
        return $this->category->whereNull('parent_id')
            ->with('childrenCategories')
            ->get();
    }

}
