<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function show(string $slug): Response
    {
        $page = Page::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return Inertia::render('Page/Show', [
            'page' => [
                'title'        => $page->title,
                'label'        => $page->label,
                'subtitle'     => $page->subtitle,
                'heading'      => $page->heading,
                'cta_text'     => $page->cta_text,
                'cta_url'      => $page->cta_url,
                'image'        => $page->image ? '/storage/' . $page->image : null,
                'content'      => $page->content,
                'show_inquiry' => $page->show_inquiry,
                'nav_group'    => $page->nav_group,
                'nav_sub'      => $page->nav_sub,
            ],
        ]);
    }
}
