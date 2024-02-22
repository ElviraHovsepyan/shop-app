<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAddressRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Models\User;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    private AddressRepositoryInterface $addressRepository;

    /**
     * @param AddressRepositoryInterface $addressRepository
     */
    public function __construct
    (
        AddressRepositoryInterface $addressRepository,
    )
    {
        $this->addressRepository = $addressRepository;
    }


    /**
     * @param CreateAddressRequest $request
     * @return SuccessResource|ErrorResource
     */
    public function store(CreateAddressRequest $request): SuccessResource|ErrorResource
    {
        $data = $request->all();
        $user = User::where('email', $data['user_email'])->first();
        if ($user) {
            $data['user_id'] =  $user->id;
        } else {
            $data['user_id'] = null;
        }

        $this->addressRepository->create($data);

        $response = (object)[
            'status' => 200,
            'message' => 'Successfully added!'
        ];
        return new SuccessResource($response);
    }


    /**

     * @return SuccessResource
     */
    public function getOne(Request $request): SuccessResource
    {
        $user = User::where('email', $request->input('email'))->first();
        $address = [];
        if ($user) {
            $address = $this->addressRepository->getAddress($request->input('email'));
        }
        $response = (object)[
            'status' => 200,
            'addresses' => $address
        ];
        return new SuccessResource($response);
    }
}
