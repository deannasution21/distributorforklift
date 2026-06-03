<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Products/Product/Index', [
            'products' => Product::with('category')
                ->orderBy('product_category_id')
                ->orderBy('id')
                ->get()
                ->map(fn ($p) => [
                    'id'            => $p->id,
                    'name'          => $p->name,
                    'slug'          => $p->slug,
                    'image'         => $p->image ? '/storage/' . $p->image : null,
                    'is_active'     => $p->is_active,
                    'category_name' => $p->category?->name,
                    'category_slug' => $p->category?->slug,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Products/Product/Form', [
            'categories' => ProductCategory::where('is_active', true)
                ->where('is_system', false)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(['id', 'name']),
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return Inertia::render('Admin/Products/Product/Form', [
            'product'    => array_merge($product->toArray(), [
                'image_url' => $product->image ? '/storage/' . $product->image : null,
            ]),
            'categories' => ProductCategory::where('is_active', true)
                ->where('is_system', false)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(['id', 'name']),
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            unset($data['image']);
        }

        if ($request->boolean('clear_image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = null;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
