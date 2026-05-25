<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $pageId = $this->route('page')?->id;

        return [
            'title'        => ['required', 'string', 'max:255'],
            'slug'         => ['nullable', 'string', 'max:255', Rule::unique('pages', 'slug')->ignore($pageId)],
            'label'        => ['nullable', 'string', 'max:100'],
            'subtitle'     => ['nullable', 'string', 'max:500'],
            'heading'      => ['nullable', 'string', 'max:500'],
            'cta_text'     => ['nullable', 'string', 'max:100'],
            'cta_url'      => ['nullable', 'string', 'max:255'],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'content'      => ['nullable', 'string'],
            'nav_group'    => ['nullable', 'string', 'max:100'],
            'nav_sub'      => ['nullable', 'string', 'max:100'],
            'nav_label'    => ['nullable', 'string', 'max:100'],
            'show_in_nav'  => ['boolean'],
            'show_inquiry' => ['boolean'],
            'is_published' => ['boolean'],
            'published_at' => ['nullable', 'date'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title'        => 'Judul',
            'slug'         => 'Slug',
            'label'        => 'Label Hero',
            'subtitle'     => 'Subtitle',
            'heading'      => 'Heading',
            'cta_text'     => 'Teks Tombol',
            'cta_url'      => 'URL Tombol',
            'image'        => 'Gambar',
            'content'      => 'Konten',
            'nav_group'    => 'Menu Utama',
            'nav_sub'      => 'Sub-Menu',
            'nav_label'    => 'Label Menu',
            'show_in_nav'  => 'Tampilkan di Nav',
            'show_inquiry' => 'Sertakan Formulir Kontak',
            'is_published' => 'Status Publikasi',
            'published_at' => 'Tanggal Publikasi',
        ];
    }
}
