<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderFormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "date_purchased" => $this->date_purchased,
            "time_purchased" => $this->time_purchased,
            "ordered_by" => $this->ordered_by,
            "business_name" => $this->business_name,
            "outlet" => $this->outlet,
            "address" => $this->address,
            "fc_without_breading" => $this->fc_without_breading,
            "fc_quantity" => $this->fc_quantity,
            "with_spicy_flavor" => $this->with_spicy_flavor,
            "with_spicy_flavor_quantity" => $this->with_spicy_flavor_quantity,
            "hot_and_spicy" => $this->hot_and_spicy,
            "hot_and_spicy_quantity" => $this->hot_and_spicy_quantity,
            "malunggay" => $this->malunggay,
            "malunggay_quantity" => $this->malunggay_quantity,
            "image" => $this->image,
            "user" => [
                "name" => $this->user->name,
                "email" => $this->user->email
            ]
            ];
    }
}
