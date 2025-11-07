<?php

namespace Keky\Product\Services;

use Keky\Product\Models\Product;
use Keky\Product\Resources\ProductResource;
use Keky\Services\Concerns\Create;
use Keky\Services\Concerns\Detail;
use Keky\Services\Concerns\ManyWithQueryMaster;
use Keky\Services\Concerns\Remove;
use Keky\Services\Concerns\Update;
use Keky\Services\Service;

class ProductService extends Service
{
    use Create, Detail, ManyWithQueryMaster, Remove, Update {

    }

        public function __construct() {}

        /**
         * {@inheritDoc}
         */
        public function model()
        {
            return Product::class;
        }

    /**
     * {@inheritDoc}
     */
    protected function resourcesCollection($data, $resource = ProductResource::class)
    {
        return $resource::collection($data);
    }

    /**
     * Model resource
     *
     * {@inheritDoc}
     */
    protected function resource($model, $resource = ProductResource::class)
    {
        return $resource::make($model);
    }
}
