<?php

namespace App\Http\Controllers;

use App\Http\Helpers\CategoryHelper;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\FileService;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{
    private $productRepository;
    private $categoryRepository;


    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct
    (
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = $this->productRepository->getAll();
        return view('product.list', [
            'products' => $products
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getOne($id)
    {
        $product = $this->productRepository->find($id);
        return view('product.one', [
            'product' => $product
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->getCategoriesTree();
        return view('product.create', [
            'categories' => $categories
        ]);
    }

    /**
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->all();
        if($request->pic){
            $data['pic'] = FileService::uploadFile($request->pic);
        }

        $category_ids = CategoryHelper::getProductCategoriesArray($request->categories);

        $product = $this->productRepository->create($data);

        $this->productRepository->syncCategories($product->id, $category_ids);

        return redirect('/products');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        $categories = $this->categoryRepository->getCategoriesTree();
        $product_cats = [];
        foreach($product->categories as $cat){
            $product_cats[] = $cat->id;
        }

        return view('product.edit', [
            'product' => $product,
            'categories' => $categories,
            'product_cats' => $product_cats
        ]);
    }

    /**
     * @param UpdateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateProductRequest $request)
    {
        $data = $request->except(['categories', 'checkboxes']);

        $product = $this->productRepository->find($request->id);

        if($request->pic){
            if($product->pic){
                FileService::removeFile($product->pic);
            }
            $data['pic'] = FileService::uploadFile($request->pic);
        }

        $category_ids = CategoryHelper::getProductCategoriesArray($request->categories);

        $this->productRepository->update($data, $request->id);

        $this->productRepository->syncCategories($product->id, $category_ids);

        return redirect('products/edit/'.$request->id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return redirect('/products');
    }

}
