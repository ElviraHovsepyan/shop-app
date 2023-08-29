<?php

namespace App\Http\Helpers;


use Illuminate\Http\Request;

class DataHelper
{

    protected static $data = [
        'order' => 'desc',
        'orderBy' => 'id',
        'limit' => 10,
        'offset' => '0',
        'keyword' => '',
        'filters' => [],
        'price' => [],
        'categories' => [],
    ];

    /**
     * @param Request|null $request
     * @return array
     */
    public static function setListParams(Request $request = null): array
    {
        if (!$request) {
            return self::$data;
        }

        if ($request->has('perPage')) {
            self::$data['limit'] = $request->perPage;
        }

        if ($request->has('filters_value') && !empty($request->filters_value)) {
            self::$data['filters'] = explode(',', $request->filters_value) ;
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

        if ($request->has('price') && !empty($request->price)) {
            self::$data['price'] = explode(',', $request->price);
        }

        if ($request->has('categories') && !empty($request->categories)) {
            self::$data['categories'] = $request->categories;
        }
        return self::$data;
    }

    /**
     * @param string $input
     * @return array
     */
    public static function getArray(string $input): array
    {
        return explode(',', $input);
    }



}
