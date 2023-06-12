<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $toArray = get_object_vars($this->resource);

        $response['success'] = true;

        foreach ($toArray as $key => $value){
            $response[$key] = $value;
        }

        return $response;
    }
}
