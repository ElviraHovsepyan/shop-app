<?php


namespace App\Traits;


trait CategoryTrait
{

    public function getCategoryPath(int $parent_id): string
    {
        $parent = $this->categoryRepository->find($parent_id);
        return $parent->path . ','.$parent_id;
    }

    public static function getProductCategoriesArray(string $categories): array
    {
        return explode(',', $categories);
    }

}

