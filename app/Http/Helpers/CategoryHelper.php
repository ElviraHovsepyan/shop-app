<?php

namespace App\Http\Helpers;

use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryHelper
{

    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoryPath($parent_id)
    {
        $parent = $this->categoryRepository->find($parent_id);
        return $parent->path . ','.$parent_id;
    }

    public static function getProductCategoriesArray($categories)
    {
        return explode(',', $categories);
    }


}