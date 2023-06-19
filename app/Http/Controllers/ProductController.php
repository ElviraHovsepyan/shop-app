<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\FileService;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getAll();
        return view('product.list', [
            'products' => $products
        ]);
    }

    public function getOne($id)
    {
        $product = $this->productRepository->find($id);
        return view('product.one', [
            'product' => $product
        ]);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(CreateProductRequest $request)
    {
        $data = $request->all();

        if($request->pic){
            $data['pic'] = FileService::uploadFile($request->pic);
        }

        $this->productRepository->create($data);
        return redirect('/products');
    }


    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        return view('product.edit', [
            'product' => $product
        ]);
    }

    public function update(UpdateProductRequest $request)
    {

        $data = $request->all();

        if($request->pic){
            $data['pic'] = FileService::uploadFile($request->pic);
        }

        $product = $this->productRepository->find($request->id);
        if($product->pic){
            FileService::removeFile($product->pic);
        }

        $this->productRepository->update($data, $request->id);
        return redirect('products/edit/'.$request->id);
    }

    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return redirect('/products');
    }

}
