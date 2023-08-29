<?php

namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Array_;

/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BasicRepository implements CategoryRepositoryInterface
{

    protected Model $model;

    protected $fields = ['name'];

    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function getCategoriesTree(): Collection
    {
        return $this->model->whereNull('parent_id')
            ->with('childrenCategories')
            ->get();
    }

    /**
     * @param $category_id
     * @return array
     */
    public function getCategoriesArray($category_id): array
    {
        $search = '|'.$category_id.'|';
        $categories = Category::without('categories')->where('path', 'like', '%'.$search.'%')->get('id')->toArray();
        $categories_array = [$category_id];
        if(count($categories)) {
            foreach ($categories as $cat) {
                $categories_array[] = $cat['id'];
            }
        }
        return $categories_array;
    }

}
