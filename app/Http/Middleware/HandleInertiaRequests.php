<?php

namespace App\Http\Middleware;

use App\Models\NavItem;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'nav_pages' => fn () => Page::where('is_published', true)
                ->where('show_in_nav', true)
                ->orderBy('nav_group')->orderBy('nav_sub')->orderBy('nav_label')
                ->get(['slug', 'nav_group', 'nav_sub', 'nav_label']),

            'nav_structure' => fn () => NavItem::whereNull('parent_id')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->with([
                    'children' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')
                        ->with(['children' => fn ($q2) => $q2->where('is_active', true)->orderBy('sort_order')]),
                ])
                ->get()
                ->map(fn ($main) => [
                    'id'       => $main->id,
                    'label'    => $main->label,
                    'href'     => $main->href,
                    'subItems' => $main->children->isEmpty() ? null : $main->children->map(fn ($sub) => [
                        'id'       => $sub->id,
                        'label'    => $sub->label,
                        'href'     => $sub->href,
                        'children' => $sub->children->isEmpty() ? null : $sub->children->map(fn ($child) => [
                            'id'    => $child->id,
                            'label' => $child->label,
                            'href'  => $child->href,
                        ])->all(),
                    ])->all(),
                ])
                ->all(),
        ];
    }
}
