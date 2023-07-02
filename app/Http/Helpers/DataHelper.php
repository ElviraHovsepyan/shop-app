<?php

namespace App\Http\Helpers;


class DataHelper
{

    protected static $data = [
        'order' => 'desc',
        'orderBy' => 'id',
        'limit' => 10,
        'offset' => '0',
        'keyword' => ''
    ];

    /**
     * @param bool $request
     * @return array
     */
    public static function setListParams($request = false): array
    {
        if (!$request) {
            return self::$data;
        }

        if ($request->has('perPage')) {
            self::$data['limit'] = $request->perPage;
        }

        if ($request->has('page')) {
            self::$data['offset'] = ($request->page - 1) * self::$data['limit'];
        }

        if ($request->has('sort')) {
            $tmp = explode('-', $request->sort);
            self::$data['orderBy'] = $tmp[0];
            self::$data['order'] = $tmp[1];
        }

        if ($request->has('search') && !empty($request->search)) {
            self::$data['keyword'] = $request->search;
        }

        return self::$data;
    }

    

}