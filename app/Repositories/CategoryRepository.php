<?php

namespace App\Repositories;


//use Your Model
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BasicRepository implements CategoryRepositoryInterface
{

    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

}
