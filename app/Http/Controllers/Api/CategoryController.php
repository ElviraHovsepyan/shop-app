<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\DataHelper;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\ListRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\SuccessResource;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Traits\CategoryTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CategoryController extends Controller
{

    use CategoryTrait;

    private CategoryRepositoryInterface $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct
    (
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * @param Request $request

     */
    public function index(Request $request)
    {
//        $data = DataHelper::setListParams();
        $categoriesData = $this->categoryRepository->getCategoriesTree();


        return [
            'categories' => $categoriesData
        ];
    }

//    /**
//     * @param ListRequest $request
//     * @return View
//     */
//    public function getFiltered(ListRequest $request): View
//    {
//        $request->flash();
//        $data = DataHelper::setListParams($request);
//        $categoriesData = $this->categoryRepository->getList($data);
//
//        return view('category.list', [
//            'categories' => $categoriesData['list'],
//            'count' => $categoriesData['count']
//        ]);
//    }
//
//    /**
//     * @return View
//     */
//    public function create(): View
//    {
//        $categories = $this->categoryRepository->getCategoriesTree();
//
//        return view('category.create', [
//            'categories' => $categories
//        ]);
//    }
//
//    /**
//     * @param CreateCategoryRequest $request
//     * @return SuccessResource
//     */
//    public function store(CreateCategoryRequest $request): SuccessResource
//    {
//        $data = $request->all();
//        $data['path'] = $this->getCategoryPath($data['parent_id']);
//
//        $this->categoryRepository->create($data);
//        $response = (object)[
//            'status' => 200,
//            'message' => 'Company Created Successfully',
//        ];
//
//        return new SuccessResource($response);
//    }
//
//
//    /**
//     * @param int $id
//     * @return View
//     */
//    public function edit(int $id): View
//    {
//        $category = $this->categoryRepository->find($id);
//        $categories = $this->categoryRepository->getCategoriesTree();
//
//        return view('category.edit', [
//            'cat' => $category,
//            'categories' => $categories
//        ]);
//    }
//
//    /**
//     * @param UpdateCategoryRequest $request
//     * @return SuccessResource
//     */
//    public function update(UpdateCategoryRequest $request): SuccessResource
//    {
//
//        $data = $request->all();
//        $data['path'] = $this->getCategoryPath($data['parent_id']);
//
//        $this->categoryRepository->update($data, $request->id);
//
//        $response = (object)[
//            'status' => 200,
//            'message' => 'Company Updated Successfully',
//        ];
//
//        return new SuccessResource($response);
//    }
//
//    /**
//     * @param int $id
//     * @return Redirector
//     */
//    public function destroy(int $id): Redirector
//    {
//        $this->categoryRepository->delete($id);
//
//        return redirect('/categories');
//    }
}
