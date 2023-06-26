<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface extends BasicRepositoryInterface
{

    /**
     * @param $productId
     * @param $categoryIds
     * @return mixed
     */
    public function syncCategories($productId, $categoryIds);

}
