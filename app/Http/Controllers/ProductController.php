<?php

namespace App\Http\Controllers;

use App\Http\Helpers\DataHelper;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ListRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\FileService;
use App\Models\FilterGroup;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\FilterGroupRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Traits\CategoryTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;
    private CategoryRepositoryInterface $categoryRepository;
    private FilterGroupRepositoryInterface $filterGroupRepository;

    use CategoryTrait;

    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param FilterGroupRepositoryInterface $filterGroupRepository
     */
    public function __construct
    (
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        FilterGroupRepositoryInterface $filterGroupRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->filterGroupRepository = $filterGroupRepository;
    }


    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $data = DataHelper::setListParams();
        $productsData = $this->productRepository->getList($data);
        $filters = $this->filterGroupRepository->getAll(['filters']);

        $request->session()->flush();

        return view('product.list', [
            'products' => $productsData['list'],
            'count' => $productsData['count'],
            'filters' => $filters
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
        $filters = $this->filterGroupRepository->getAll(['filters']);


        return view('product.list', [
            'products' => $productsData['list'],
            'count' => $productsData['count'],
            'filters' => $filters
        ]);
    }


    /**
     * @param int $id
     * @return View
     */
    public function getOne(int $id): View
    {
        $product = $this->productRepository->find($id, ['categories', 'filters']);

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
        $filters = $this->filterGroupRepository->getAll(['filters']);


        return view('product.create', [
            'categories' => $categories,
            'filters' => $filters
        ]);
    }

    /**
     * @param CreateProductRequest $request
     * @return RedirectResponse
     */
    public function store(CreateProductRequest $request): RedirectResponse
    {
        $data = $request->all();
        if ($request->pic) {
            $data['pic'] = FileService::uploadFile($request->pic);
        }

        $category_ids = DataHelper::getArray($request->categories);
        $filter_ids = DataHelper::getArray($request->filters_value);

        $product = $this->productRepository->create($data);

        $this->productRepository->syncCategories($product->id, $category_ids);
        $this->productRepository->syncFilters($product->id, $filter_ids);

        return redirect('/products');
    }


    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $product = $this->productRepository->find($id, ['categories', 'filters']);
        $categories = $this->categoryRepository->getCategoriesTree();
        $product_cats = [];
        $product_filter_ids = [];
        $filters = $this->filterGroupRepository->getAll(['filters']);

        foreach ($product->categories as $cat) {
            $product_cats[] = $cat->id;
        }

        foreach ($product->filters as $filter) {
            $product_filter_ids[] = $filter->id;
        }

        return view('product.edit', [
            'product' => $product,
            'categories' => $categories,
            'product_cats' => $product_cats,
            'filters' => $filters,
            'filter_ids' => $product_filter_ids
        ]);
    }

    /**
     * @param UpdateProductRequest $request
     * @return RedirectResponse|Redirector
     */
    public function update(UpdateProductRequest $request): Redirector|RedirectResponse
    {
        $data = $request->except(['categories', 'checkboxes', 'filters_value', 'filters']);
        $product = $this->productRepository->find($request->id, ['categories', 'filters']);

        if ($request->pic) {
            if ($product->pic) {
                FileService::removeFile($product->pic);
            }
            $data['pic'] = FileService::uploadFile($request->pic);
        }

        $category_ids = DataHelper::getArray($request->categories);
        $filter_ids = DataHelper::getArray($request->filters_value);

        $this->productRepository->update($data, $request->id);

        $this->productRepository->syncCategories($product->id, $category_ids);
        $this->productRepository->syncFilters($product->id, $filter_ids);

        return redirect('products/edit/'.$request->id);
    }

    /**
     * @param int $id
     * @return Redirector
     */
    public function destroy(int $id): Redirector
    {
        $this->productRepository->delete($id);

        return redirect('/products');
    }

}
