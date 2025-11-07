<?php

namespace Keky\Product\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'subtitle' => $this->resource->subtitle,
            'description' => $this->resource->description,
            'slug' => $this->resource->slug,
            'status' => $this->resource->status,
            'external_id' => $this->resource->external_id,
            'thumbnail' => $this->resource->thumbnail,
            'price' => $this->resource->price,
            'buy_price' => $this->resource->buy_price,
            'sku' => $this->resource->sku,
            'unit' => $this->resource->unit,
            'currency' => $this->resource->currency,
            'weight' => $this->resource->weight,
            'height' => $this->resource->height,
            'width' => $this->resource->width,
            'type_id' => $this->resource->type_id,
            'metadata' => $this->resource->metadata,
        ];
    }
}
