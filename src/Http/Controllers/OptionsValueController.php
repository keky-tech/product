<?php

namespace Keky\Product\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Keky\Product\Http\Requests\OptionValueRequest;
use Keky\Product\Models\OptionValue;
use Symfony\Component\HttpFoundation\Response;

class OptionsValueController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(private OptionValue $optionValue)
    {
    }

    public function store(OptionValueRequest $optionValueRequest)
    {
        $optionValue = $this->optionValue->newQuery()->create($optionValueRequest->all());
        if (! ($optionValue instanceof OptionValue)) {
            return response()->json([
                'success' => 'failed',
                'message' => 'Internal server error !',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'success' => 'ok',
            'data' => $optionValue->toArray(),
        ], Response::HTTP_CREATED);
    }
}
