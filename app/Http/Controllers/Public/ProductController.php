<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(): Response
    {
        $systemCategory = ProductCategory::where('is_system', true)->first();

        $categories = ProductCategory::where('is_active', true)
            ->where('is_system', false)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->withCount(['products' => fn ($q) => $q->where('is_active', true)])
            ->get(['id', 'name', 'slug', 'description', 'image', 'products_count']);

        $products = Product::with('category')
            ->where('is_active', true)
            ->get()
            ->map(fn ($p) => [
                'id'               => $p->id,
                'name'             => $p->name,
                'slug'             => $p->slug,
                'short_description'=> $p->short_description,
                'specs'            => $p->specs ?? [],
                'image'            => $p->image ? '/storage/' . $p->image : null,
                'category_name'    => $p->category?->name,
                'category_slug'    => $p->category?->slug,
            ]);

        return Inertia::render('Products/Index', [
            'categories' => $categories,
            'products'   => $products,
            'hero'       => [
                'label'        => 'Katalog Produk',
                'name'         => $systemCategory?->name ?? 'Produk',
                'description'  => $systemCategory?->description,
                'image'        => $systemCategory?->image ? '/storage/' . $systemCategory->image : null,
                'show_inquiry' => $systemCategory?->show_inquiry ?? true,
            ],
        ]);
    }

    public function category(string $categorySlug): Response
    {
        $category = ProductCategory::where('slug', $categorySlug)
            ->where('is_active', true)
            ->firstOrFail();

        $products = Product::where('product_category_id', $category->id)
            ->where('is_active', true)
            ->get()
            ->map(fn ($p) => [
                'id'               => $p->id,
                'name'             => $p->name,
                'slug'             => $p->slug,
                'short_description'=> $p->short_description,
                'specs'            => $p->specs ?? [],
                'image'            => $p->image ? '/storage/' . $p->image : null,
                'category_name'    => $category->name,
                'category_slug'    => $category->slug,
            ]);

        $allCategories = ProductCategory::where('is_active', true)
            ->where('is_system', false)
            ->orderBy('sort_order')
            ->get(['id', 'name', 'slug']);

        return Inertia::render('Products/Index', [
            'categories'     => $allCategories,
            'products'       => $products,
            'activeCategory' => [
                'id'           => $category->id,
                'name'         => $category->name,
                'slug'         => $category->slug,
                'description'  => $category->description,
                'show_inquiry' => $category->show_inquiry,
            ],
            'hero' => [
                'label'        => 'Katalog Produk',
                'name'         => $category->name,
                'description'  => $category->description,
                'image'        => $category->image ? '/storage/' . $category->image : null,
                'show_inquiry' => $category->show_inquiry,
            ],
        ]);
    }

    public function show(string $categorySlug, string $productSlug): Response
    {
        $category = ProductCategory::where('slug', $categorySlug)
            ->where('is_active', true)
            ->firstOrFail();

        $product = Product::where('slug', $productSlug)
            ->where('product_category_id', $category->id)
            ->where('is_active', true)
            ->firstOrFail();

        return Inertia::render('Products/Show', [
            'product'  => [
                'id'               => $product->id,
                'name'             => $product->name,
                'short_description'=> $product->short_description,
                'full_description' => $product->full_description,
                'specs'            => $product->specs ?? [],
                'image'            => $product->image ? '/storage/' . $product->image : null,
            ],
            'category' => [
                'name' => $category->name,
                'slug' => $category->slug,
            ],
        ]);
    }
}
