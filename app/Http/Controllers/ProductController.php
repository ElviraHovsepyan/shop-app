<?php

namespace App\Http\Controllers;

use App\Http\Helpers\DataHelper;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ListRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\FileService;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Traits\CategoryTrait;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ProductController extends Controller
{
    private $productRepository;
    private $categoryRepository;

    use CategoryTrait;

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
     * @return View
     */
    public function index(): View
    {
        $data = DataHelper::setListParams();
        $productsData = $this->productRepository->getList($data);

        return view('product.list', [
            'products' => $productsData['list'],
            'count' => $productsData['count']
        ]);
    }

    /**
     * @param ListRequest $request
     * @return View
     */
    public function getFiltered(ListRequest $request): View
    {
        $request->flash();
        $data = DataHelper::setListParams($request);
        $productsData = $this->productRepository->getList($data);

        return view('product.list', [
            'products' => $productsData['list'],
            'count' => $productsData['count']
        ]);
    }


    /**
     * @param int $id
     * @return View
     */
    public function getOne(int $id): View
    {
        $product = $this->productRepository->find($id);

        return view('product.one', [
            'product' => $product
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
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
    public function store(CreateProductRequest $request): Redirector
    {
        $data = $request->all();
        if ($request->pic) {
            $data['pic'] = FileService::uploadFile($request->pic);
        }

        $category_ids = $this->getProductCategoriesArray($request->categories);

        $product = $this->productRepository->create($data);

        $this->productRepository->syncCategories($product->id, $category_ids);

        return redirect('/products');
    }


    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $product = $this->productRepository->find($id);
        $categories = $this->categoryRepository->getCategoriesTree();
        $product_cats = [];

        foreach ($product->categories as $cat) {
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

        if ($request->pic) {
            if ($product->pic) {
                FileService::removeFile($product->pic);
            }
            $data['pic'] = FileService::uploadFile($request->pic);
        }

        $category_ids = $this->getProductCategoriesArray($request->categories);

        $this->productRepository->update($data, $request->id);

        $this->productRepository->syncCategories($product->id, $category_ids);

        return redirect('products/edit/'.$request->id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(int $id): Redirector
    {
        $this->productRepository->delete($id);

        return redirect('/products');
    }

}
