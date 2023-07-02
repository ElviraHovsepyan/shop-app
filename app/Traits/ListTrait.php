<?php


namespace App\Traits;


trait ListTrait
{

    /**
     * @param array $data
     * @return array
     */
    public function getList(array $data): array
    {
        $query = $this->model->newQuery();

        if(!empty($data['keyword'])) {
            $query = $query->where('name', 'like', '%' . $data['keyword'] . '%');
        }

        $count = count($query->get());

        if ($data['orderBy'] == 'price') {

            $query = $query->orderByRaw('CAST(price as DECIMAL(8,2)) '. $data['order']);

        } else {

            $query = $query->orderBy($data['orderBy'], $data['order']);
        }
        $list =  $query->offset($data['offset'])->limit($data['limit'])->get();

        return ['list' => $list, 'count' => ceil($count / $data['limit'])];
    }

}