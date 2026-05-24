<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HeroSliderRequest;
use App\Models\HeroSlider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class HeroSliderController extends Controller
{
    public function index(): Response
    {
        $sliders = HeroSlider::orderBy('order')->orderBy('id')->get();

        return Inertia::render('Admin/Slider/Index', [
            'sliders' => $sliders,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Slider/Create');
    }

    public function store(HeroSliderRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['show_cta'] = $request->boolean('show_cta');
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        if (! $data['show_cta']) {
            $data['cta_text'] = null;
            $data['cta_url']  = null;
        }

        HeroSlider::create($data);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider berhasil ditambahkan.');
    }

    public function edit(HeroSlider $slider): Response
    {
        return Inertia::render('Admin/Slider/Edit', [
            'slider' => $slider,
        ]);
    }

    public function update(HeroSliderRequest $request, HeroSlider $slider): RedirectResponse
    {
        $data = $request->validated();
        $data['show_cta'] = $request->boolean('show_cta');
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = $request->file('image')->store('sliders', 'public');
        } else {
            unset($data['image']);
        }

        if (! $data['show_cta']) {
            $data['cta_text'] = null;
            $data['cta_url']  = null;
        }

        $slider->update($data);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider berhasil diperbarui.');
    }

    public function destroy(HeroSlider $slider): RedirectResponse
    {
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider berhasil dihapus.');
    }
}
