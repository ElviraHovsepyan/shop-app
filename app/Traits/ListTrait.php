<?php


namespace App\Traits;


use Illuminate\Support\Facades\Schema;

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

            foreach($this->fields as $key => $field) {
                if ($key = 0) {
                    $query = $query->where($field, 'like', '%' . $data['keyword'] . '%');
                } else {
                    $query = $query->orWhere($field, 'like', '%' . $data['keyword'] . '%');
                }
            }
        }


        if (!empty($data['filters'])) {

            $query = $query->with('filters')->whereHas('filters', function ($query) use ($data)  {
                $query->whereIn('filter_id', $data['filters']);
            });
        }

        $count = $query->count();


        if ($data['orderBy'] == 'price') {

            $query = $query->orderByRaw('CAST(price as DECIMAL(8,2)) '. $data['order']);
        } else {

            if (Schema::hasColumn($this->model->getTable(), $data['orderBy'])) {
                $query = $query->orderBy($data['orderBy'], $data['order']);
            } else {
                $query = $query->orderBy('id', 'desc');
            }
        }
        $list =  $query->offset($data['offset'])->limit($data['limit'])->get();
        return ['list' => $list, 'count' => ceil($count / $data['limit'])];
    }

}
