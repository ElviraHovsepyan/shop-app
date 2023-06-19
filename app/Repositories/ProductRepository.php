<?php

namespace App\Repositories;


//use Your Model
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

/**
 * Class CategoryRepository.
 */
class ProductRepository extends BasicRepository implements ProductRepositoryInterface
{

    public function __construct(Product $category)
    {
        parent::__construct($category);
    }

}
