<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response as Response;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                Rule::unique('products', 'name')->ignore($this->product),
                'required',
            ],

            'price' => [
                'numeric',
                'required',
            ],

            'description' => [
                'required',
            ],

            'category' => [
                'required',
                'max:1024',
            ],

            'image_url' => [
                'sometimes',
                'nullable',
                'url',
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()
            ->json($validator
                ->errors()
                ->messages(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
