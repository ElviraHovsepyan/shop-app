<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\SuccessResource;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Traits\CategoryTrait;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CategoryController extends Controller
{

    use CategoryTrait;

    private $categoryRepository;

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
     * @return View
     */
    public function index(): View
    {
        $categories = $this->categoryRepository->getAll();

        return view('category.list', [
            'categories' => $categories
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
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
    public function store(CreateCategoryRequest $request): SuccessResource
    {
        $data = $request->all();
        $data['path'] = $this->getCategoryPath($data['parent_id']);

        $this->categoryRepository->create($data);
        $response = (object)[
            'status' => 200,
            'message' => 'Company Created Successfully',
        ];

        return new SuccessResource($response);
    }


    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
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
    public function update(UpdateCategoryRequest $request): SuccessResource
    {

        $data = $request->all();
        $data['path'] = $this->getCategoryPath($data['parent_id']);

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
    public function destroy(int $id): Redirector
    {
        $this->categoryRepository->delete($id);

        return redirect('/categories');
    }
}
