<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface BasketRepositoryInterface extends BasicRepositoryInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function syncProducts($data): mixed;

}
