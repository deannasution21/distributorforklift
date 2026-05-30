<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageShowcase;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class HomepageShowcaseController extends Controller
{
    public function edit(): Response
    {
        $setting   = SiteSetting::firstOrCreate([]);
        $showcases = HomepageShowcase::all()->keyBy(fn ($s) => "{$s->row}_{$s->position}");

        $rows = [];
        for ($r = 1; $r <= 3; $r++) {
            for ($p = 1; $p <= 3; $p++) {
                $s = $showcases->get("{$r}_{$p}");
                $rows[$r][$p] = [
                    'title'       => $s?->title,
                    'description' => $s?->description,
                    'image'       => $s?->image ? '/storage/' . $s->image : null,
                    'href'        => $s?->href,
                ];
            }
        }

        return Inertia::render('Admin/Homepage/Showcase', [
            'heading' => $setting->showcase_heading,
            'rows'    => $rows,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'heading'                         => 'nullable|string|max:500',
            'cards.*.title'                   => 'nullable|string|max:255',
            'cards.*.description'             => 'nullable|string|max:500',
            'cards.*.href'                    => 'nullable|string|max:255',
            'cards.*.image'                   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $setting = SiteSetting::firstOrCreate([]);
        $setting->update(['showcase_heading' => $request->heading]);

        foreach ($request->cards as $card) {
            $row      = (int) $card['row'];
            $position = (int) $card['position'];

            $showcase = HomepageShowcase::firstOrCreate(
                ['row' => $row, 'position' => $position]
            );

            $updateData = [
                'title'       => $card['title'] ?? null,
                'description' => $card['description'] ?? null,
                'href'        => $card['href'] ?? null,
            ];

            if (!empty($card['image']) && $card['image'] instanceof \Illuminate\Http\UploadedFile) {
                if ($showcase->image) {
                    Storage::disk('public')->delete($showcase->image);
                }
                $updateData['image'] = $card['image']->store('showcase', 'public');
            } elseif (!empty($card['clear_image'])) {
                if ($showcase->image) {
                    Storage::disk('public')->delete($showcase->image);
                }
                $updateData['image'] = null;
            }

            $showcase->update($updateData);
        }

        return back()->with('success', 'Showcase berhasil disimpan.');
    }
}
