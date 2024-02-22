<?php

namespace App\Repositories;


use App\Models\Address;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryRepository.
 */
class AddressRepository extends BasicRepository implements AddressRepositoryInterface
{

    protected Model $model;


    /**
     * CategoryRepository constructor.
     * @param Address $model
     */
    public function __construct(Address $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param $email
     * @return Collection
     */
    public function getAddress($email): Collection
    {
        return $this->model->with('country')->whereHas('user', function ($query) use ($email) {
            $query->where('email', $email);
        })->get();
    }


}
