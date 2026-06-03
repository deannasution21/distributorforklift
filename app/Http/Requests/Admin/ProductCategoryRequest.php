<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
        $categoryId = $this->route('category')?->id;

        return [
            'name'        => ['required', 'string', 'max:255'],
            'slug'        => ['nullable', 'string', 'max:255', 'unique:product_categories,slug,' . $categoryId],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'image', 'max:2048'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
            'is_active'   => ['boolean'],
            'nav_group'   => ['nullable', 'string', 'max:255'],
            'nav_sub'     => ['nullable', 'string', 'max:255'],
            'nav_label'   => ['nullable', 'string', 'max:255'],
            'show_in_nav' => ['boolean'],
            'show_inquiry' => ['boolean'],
        ];
    }
}
