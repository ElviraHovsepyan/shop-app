<?php

namespace App\Http\Controllers;

use App\Http\Helpers\CategoryHelper;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\SuccessResource;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    private $categoryRepository;
    private $categoryHelper;

    /**
     * CategoryController constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     * @param CategoryHelper $categoryHelper
     */
    public function __construct
    (
        CategoryRepositoryInterface $categoryRepository,
        CategoryHelper $categoryHelper
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryHelper = $categoryHelper;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $categories = $this->categoryRepository->getAll();
        return view('category.list', [
            'categories' => $categories
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->getCategoriesTree();

        return view('category.create', [
            'categories' => $categories
        ]);
    }

    /**
     * @param CreateCategoryRequest $request
     * @return SuccessResource
     */
    public function store(CreateCategoryRequest $request)
    {
        $data = $request->all();
        $data['path'] = $this->categoryHelper->getCategoryPath($data['parent_id']);

        $this->categoryRepository->create($data);
        $response = (object)[
            'status' => 200,
            'message' => 'Company Created Successfully',
        ];
        return new SuccessResource($response);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        $categories = $this->categoryRepository->getCategoriesTree();

        return view('category.edit', [
            'cat' => $category,
            'categories' => $categories
        ]);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @return SuccessResource
     */
    public function update(UpdateCategoryRequest $request)
    {

        $data = $request->all();
        $data['path'] = $this->categoryHelper->getCategoryPath($data['parent_id']);

        $this->categoryRepository->update($data, $request->id);

        $response = (object)[
            'status' => 200,
            'message' => 'Company Updated Successfully',
        ];
        return new SuccessResource($response);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return redirect('/categories');
    }
}
