<?php

namespace App\Http\Requests;
use App\Models\Product;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
class UpdateProductRequest extends BaseFormRequest implements Authenticatable
{
    use AuthenticatableTrait;
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'A name is required',
            'name.string' => 'A name must be a string',
            'name.max' => 'A name must be less than 255 characters',
            'description.string' => 'A description must be a string',
            'description.max' => 'A description must be less than 1000 characters',
            'price.required' => 'A price is required',
            'price.numeric' => 'A price must be a number',
            'price.min' => 'A price must be greater than 0',
        ];
    }
}
