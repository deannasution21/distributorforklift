<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product')?->id;

        return [
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'name'                => ['required', 'string', 'max:255'],
            'slug'                => ['nullable', 'string', 'max:255', 'unique:products,slug,' . $productId],
            'short_description'   => ['nullable', 'string'],
            'full_description'    => ['nullable', 'string'],
            'specs'               => ['nullable', 'array'],
            'specs.*.label'       => ['required_with:specs', 'string', 'max:100'],
            'specs.*.value'       => ['required_with:specs', 'string', 'max:255'],
            'image'               => ['nullable', 'image', 'max:3072'],
            'is_active'           => ['boolean'],
        ];
    }
}
