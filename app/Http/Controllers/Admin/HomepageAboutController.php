<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HomepageAboutRequest;
use App\Models\HomepageAbout;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomepageAboutController extends Controller
{
    public function edit()
    {
        $about = HomepageAbout::firstOrCreate([], [
            'section_title' => 'Tentang Perusahaan',
            'title'         => 'Mitra terpercaya solusi material handling industri Indonesia',
            'description'   => 'Kami mengimplementasikan pengelolaan cerdas peralatan material handling, perangkat lunak, dan layanan untuk berbagai industri besar di Indonesia.',
            'box_title'     => 'Distributor Forklift',
            'box_description' => 'Kami adalah distributor forklift terpercaya dengan pengalaman lebih dari 20 tahun melayani berbagai industri besar.',
            'show_cta'      => false,
        ]);

        return Inertia::render('Admin/Homepage/Tentang', ['about' => $about]);
    }

    public function update(HomepageAboutRequest $request)
    {
        $about = HomepageAbout::firstOrCreate([]);

        $data = $request->validated();
        $data['show_cta'] = $request->boolean('show_cta');

        if (!$data['show_cta']) {
            $data['cta_text'] = null;
            $data['cta_url']  = null;
        }

        if ($request->hasFile('image')) {
            if ($about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $data['image'] = $request->file('image')->store('homepage', 'public');
        } else {
            unset($data['image']);
        }

        $about->update($data);

        return back()->with('success', 'Konten Tentang berhasil diperbarui.');
    }
}
