<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface extends BasicRepositoryInterface
{

    /**
     * @return mixed
     */
    public function getCategoriesTree();

}
