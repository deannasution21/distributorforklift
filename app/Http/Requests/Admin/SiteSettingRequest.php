<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone'     => ['nullable', 'string', 'max:30'],
            'whatsapp'  => ['nullable', 'string', 'max:30'],
            'email'     => ['nullable', 'email', 'max:255'],
            'address'   => ['nullable', 'string', 'max:1000'],
            'youtube'   => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:100'],
            'tiktok'    => ['nullable', 'string', 'max:100'],
            'facebook'  => ['nullable', 'string', 'max:100'],
        ];
    }

    public function attributes(): array
    {
        return [
            'phone'     => 'Nomor Telepon',
            'whatsapp'  => 'Nomor WhatsApp',
            'email'     => 'Email Perusahaan',
            'address'   => 'Alamat',
            'youtube'   => 'YouTube',
            'instagram' => 'Instagram',
            'tiktok'    => 'TikTok',
            'facebook'  => 'Facebook',
        ];
    }
}
