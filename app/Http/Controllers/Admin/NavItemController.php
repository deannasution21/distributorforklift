<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NavItemController extends Controller
{
    public function index(): Response
    {
        $items = NavItem::whereNull('parent_id')
            ->orderBy('sort_order')
            ->with(['children' => fn ($q) => $q->orderBy('sort_order')
                ->with(['children' => fn ($q2) => $q2->orderBy('sort_order')])
            ])
            ->get();

        return Inertia::render('Admin/Navigation/Index', ['items' => $items]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'parent_id' => ['nullable', 'exists:nav_items,id'],
            'label'     => ['required', 'string', 'max:100'],
            'href'      => ['nullable', 'string', 'max:255'],
        ]);

        $level = 1;
        if ($data['parent_id']) {
            $parent = NavItem::findOrFail($data['parent_id']);
            $level = $parent->level + 1;
        }

        $maxOrder = NavItem::where('parent_id', $data['parent_id'] ?? null)->max('sort_order') ?? 0;

        NavItem::create([
            'parent_id'  => $data['parent_id'] ?? null,
            'level'      => $level,
            'label'      => $data['label'],
            'href'       => $data['href'] ?? null,
            'sort_order' => $maxOrder + 1,
        ]);

        return back()->with('success', 'Item berhasil ditambahkan.');
    }

    public function update(Request $request, NavItem $navItem): RedirectResponse
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:100'],
            'href'  => ['nullable', 'string', 'max:255'],
        ]);

        $navItem->update([
            'label' => $data['label'],
            'href'  => $data['href'] ?: null,
        ]);

        return back()->with('success', 'Item berhasil diperbarui.');
    }

    public function destroy(NavItem $navItem): RedirectResponse
    {
        $navItem->delete(); // cascade via DB constraint

        return back()->with('success', 'Item berhasil dihapus.');
    }

    public function move(Request $request, NavItem $navItem): RedirectResponse
    {
        $direction = $request->validate(['direction' => ['required', 'in:up,down']])['direction'];

        $siblings = NavItem::where('parent_id', $navItem->parent_id)
            ->orderBy('sort_order')
            ->get();

        $index = $siblings->search(fn ($s) => $s->id === $navItem->id);

        if ($direction === 'up' && $index > 0) {
            $swap = $siblings[$index - 1];
        } elseif ($direction === 'down' && $index < $siblings->count() - 1) {
            $swap = $siblings[$index + 1];
        } else {
            return back();
        }

        [$navItem->sort_order, $swap->sort_order] = [$swap->sort_order, $navItem->sort_order];
        $navItem->save();
        $swap->save();

        return back();
    }
}

