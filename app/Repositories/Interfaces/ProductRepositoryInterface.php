<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface extends BasicRepositoryInterface
{


    /**
     * @param int $productId
     * @param array $categoryIds
     * @return mixed
     */
    public function syncCategories(int $productId, array $categoryIds);

}
