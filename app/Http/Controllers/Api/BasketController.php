<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToBasketRequest;
use App\Http\Requests\UpdateBasketRequest;
use App\Http\Resources\BasketResource;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Repositories\Interfaces\BasketRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{

    private BasketRepositoryInterface $basketRepository;
    private ProductRepositoryInterface $productRepository;

    /**
     * @param BasketRepositoryInterface $basketRepository
     */
    public function __construct
    (
        BasketRepositoryInterface $basketRepository,
        ProductRepositoryInterface $productRepository,
    )
    {
       $this->basketRepository = $basketRepository;
       $this->productRepository = $productRepository;
    }

    /**
//     * @return BasketResource
     */
    public function index()
    {
        if (Auth::user()) {
           $items = $this->productRepository->getBasketItems(Auth::user()->id);
        }
        return BasketResource::collection($items);

    }

    /**
     * @param AddToBasketRequest $request
     * @return SuccessResource|ErrorResource
     */
    public function store(AddToBasketRequest $request): SuccessResource|ErrorResource
    {
        $data = $request->all();
        if (Auth::user()) {
            $data['user_id'] =  Auth::user()->id;
        } else {
            $data['user_id'] = null;
        }
        $product = $this->productRepository->find($data['product_id']);

        if (!$product) {
            return new ErrorResource((object)['code' => 404, 'message' => 'Product not found!']);
        }

        $this->basketRepository->syncProducts($data);
        $response = (object)[
            'status' => 200,
            'message' => 'Successfully added!'
        ];
        return new SuccessResource($response);
    }

    public function update(UpdateBasketRequest $request)
    {
        $data = $request->except('id');
        $item = $this->basketRepository->find($request->id);
        if(!$item) {
            return new ErrorResource((object)['code' => 404, 'message' => 'Item not found!']);
        }
        $this->basketRepository->update($data, $request->id);
        $response = (object)[
            'status' => 200,
            'message' => 'Successfully updated!'
        ];
        return new SuccessResource($response);
    }

    /**
     * @param int $id
     * @return SuccessResource|ErrorResource
     */
    public function destroy(int $id): SuccessResource|ErrorResource
    {
        $item = $this->basketRepository->find($id);
        if(!$item) {
            return new ErrorResource((object)['code' => 404, 'message' => 'Item not found!']);
        }
        $this->basketRepository->delete($id);

        $response = (object)[
            'status' => 200,
            'message' => 'Successfully deleted!'
        ];
        return new SuccessResource($response);
    }

    public function deleteOneProduct($id)
    {
        $item = $this->basketRepository->find($id);
        if(!$item) {
            return new ErrorResource((object)['code' => 404, 'message' => 'Item not found!']);
        }
        $this->basketRepository->deleteOne($id);

        $response = (object)[
            'status' => 200,
            'message' => 'Successfully deleted!'
        ];
        return new SuccessResource($response);
    }


}
