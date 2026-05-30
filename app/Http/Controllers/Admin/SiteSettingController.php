<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class SiteSettingController extends Controller
{
    public function edit(): Response
    {
        $setting = SiteSetting::firstOrCreate([]);

        return Inertia::render('Admin/Settings/Edit', [
            'setting' => [
                'phone'     => $setting->phone,
                'whatsapp'  => $setting->whatsapp,
                'email'     => $setting->email,
                'address'   => $setting->address,
                'youtube'   => $setting->youtube,
                'instagram' => $setting->instagram,
                'tiktok'    => $setting->tiktok,
                'facebook'  => $setting->facebook,
            ],
        ]);
    }

    public function update(SiteSettingRequest $request): RedirectResponse
    {
        $setting = SiteSetting::firstOrCreate([]);
        $setting->update($request->validated());

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}
