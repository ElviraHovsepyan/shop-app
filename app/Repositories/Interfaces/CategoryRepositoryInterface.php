<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface extends BasicRepositoryInterface
{

    /**
     * @return mixed
     */
    public function getCategoriesTree(): Collection;

}
