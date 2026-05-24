<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HomepageAboutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'section_title'    => 'required|string|max:255',
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'box_title'        => 'nullable|string|max:255',
            'box_description'  => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'show_cta'         => 'boolean',
            'cta_text'         => 'nullable|string|max:255|required_if:show_cta,true',
            'cta_url'          => 'nullable|string|max:255|required_if:show_cta,true',
            'long_description' => 'nullable|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'section_title'   => 'judul section',
            'title'           => 'judul',
            'box_title'       => 'judul box',
            'cta_text'        => 'teks tombol CTA',
            'cta_url'         => 'URL tombol CTA',
            'long_description'=> 'deskripsi panjang',
        ];
    }
}
