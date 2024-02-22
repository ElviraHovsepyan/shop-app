<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface AddressRepositoryInterface extends BasicRepositoryInterface
{
    public function getAddress($email): Collection;

}
