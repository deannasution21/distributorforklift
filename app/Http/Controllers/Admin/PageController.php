<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function index(): Response
    {
        $pages = Page::latest('id')
            ->paginate(15)
            ->through(fn ($p) => [
                'id'           => $p->id,
                'title'        => $p->title,
                'slug'         => $p->slug,
                'nav_group'    => $p->nav_group,
                'show_in_nav'  => $p->show_in_nav,
                'is_published' => $p->is_published,
                'image'        => $p->image ? '/storage/' . $p->image : null,
            ]);

        return Inertia::render('Admin/Page/Index', [
            'pages' => $pages,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Page/Create');
    }

    public function store(PageRequest $request): RedirectResponse
    {
        $data                = $request->validated();
        $data['is_published'] = $request->boolean('is_published');
        $data['show_in_nav']  = $request->boolean('show_in_nav');
        $data['show_inquiry'] = $request->boolean('show_inquiry');
        $data['slug']         = $data['slug'] ?: Str::slug($data['title']);

        if (empty($data['published_at'])) {
            $data['published_at'] = $data['is_published'] ? now() : null;
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pages', 'public');
        }

        Page::create($data);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman berhasil ditambahkan.');
    }

    public function edit(Page $page): Response
    {
        return Inertia::render('Admin/Page/Edit', [
            'page' => [
                'id'           => $page->id,
                'title'        => $page->title,
                'slug'         => $page->slug,
                'label'        => $page->label,
                'subtitle'     => $page->subtitle,
                'heading'      => $page->heading,
                'cta_text'     => $page->cta_text,
                'cta_url'      => $page->cta_url,
                'image'        => $page->image ? '/storage/' . $page->image : null,
                'content'      => $page->content,
                'nav_group'    => $page->nav_group,
                'nav_sub'      => $page->nav_sub,
                'nav_label'    => $page->nav_label,
                'show_in_nav'  => $page->show_in_nav,
                'show_inquiry' => $page->show_inquiry,
                'is_published' => $page->is_published,
                'published_at' => $page->published_at?->format('Y-m-d'),
            ],
        ]);
    }

    public function update(PageRequest $request, Page $page): RedirectResponse
    {
        $data                = $request->validated();
        $data['is_published'] = $request->boolean('is_published');
        $data['show_in_nav']  = $request->boolean('show_in_nav');
        $data['show_inquiry'] = $request->boolean('show_inquiry');
        $data['slug']         = $data['slug'] ?: Str::slug($data['title']);

        if (empty($data['published_at']) && $data['is_published'] && ! $page->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            if ($page->image) {
                Storage::disk('public')->delete($page->image);
            }
            $data['image'] = $request->file('image')->store('pages', 'public');
        } else {
            unset($data['image']);
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        if ($page->image) {
            Storage::disk('public')->delete($page->image);
        }

        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman berhasil dihapus.');
    }
}
