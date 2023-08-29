<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BasketResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'pic' => $this->pic,
            'basket' => [
                'id' => $this->basket[0]->id,
                'product_id' => $this->basket[0]->product_id,
                'user_id' => $this->basket[0]->user_id,
                'count' => $this->basket[0]->count
            ]
        ];
    }
}
