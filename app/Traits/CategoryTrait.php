<?php


namespace App\Traits;


trait CategoryTrait
{

    /**
     * @param int $parent_id
     * @return string
     */
    public function getCategoryPath(int $parent_id): string
    {
        $parent = $this->categoryRepository->find($parent_id);
        if ($parent->path) {
            $path = $parent->path . $parent_id . '|';
        } else {
            $path = '|'.$parent_id . '|';
        }
        return $path;
    }


}

