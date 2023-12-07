<?php

namespace Keky\Product\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'slug' => 'nullable|string|unique:products,id,'.request()->route('id'),
            'status' => 'required|in:draft,published,rejected',
            'thumbnail' => 'nullable|string',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'type_id' => 'nullable|string',
            'metadata' => 'nullable|json',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        //parent::failedValidation($validator); // TODO: Change the autogenerated stub
        throw new HttpResponseException(
            response()->json(
                [
                    'status' => 'failed',
                    'message' => 'Something went wrong',
                    'errors' => $validator->errors(),
                ],
                422
            ));
    }
}
