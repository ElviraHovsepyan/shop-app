<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @param $user_id
     * @return Collection
     */
    public function getBasketItems($user_id): Collection;


}
