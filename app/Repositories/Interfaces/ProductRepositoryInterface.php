<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface extends BasicRepositoryInterface
{


    /**
     * @param int $productId
     * @param array $categoryIds
     * @return void
     */
    public function syncCategories(int $productId, array $categoryIds): void;

    /**
     * @param int $productId
     * @param array $filterIds
     * @return void
     */
    public function syncFilters(int $productId, array $filterIds): void;


}
