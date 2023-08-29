<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Repositories\Interfaces\CountryRepositoryInterface;

class CountryController extends Controller
{

    private CountryRepositoryInterface $countryRepository;


    /**
     * @param CountryRepositoryInterface $countryRepository
     */
    public function __construct
    (
        CountryRepositoryInterface $countryRepository
    )
    {
        $this->countryRepository = $countryRepository;
    }


    public function index()
    {
        $countries = $this->countryRepository->getAll();
        $response = (object)[
            'status' => 200,
            'countries' => $countries
        ];
        return new SuccessResource($response);
    }
}
