<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCategoryRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::withCount('products')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $totalProducts = Product::count();

        $categories->each(function ($cat) use ($totalProducts) {
            if ($cat->is_system) {
                $cat->products_count = $totalProducts;
            }
        });

        return Inertia::render('Admin/Products/Category/Index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Products/Category/Form');
    }

    public function store(ProductCategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('product-categories', 'public');
        }

        ProductCategory::create($data);

        return redirect()->route('admin.product-categories.index')
            ->with('success', 'Kategori produk berhasil ditambahkan.');
    }

    public function edit(ProductCategory $category)
    {
        return Inertia::render('Admin/Products/Category/Form', [
            'category' => $category,
        ]);
    }

    public function update(ProductCategoryRequest $request, ProductCategory $category)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($category->image) Storage::disk('public')->delete($category->image);
            $data['image'] = $request->file('image')->store('product-categories', 'public');
        } else {
            unset($data['image']);
        }

        if ($request->boolean('clear_image')) {
            if ($category->image) Storage::disk('public')->delete($category->image);
            $data['image'] = null;
        }

        $category->update($data);

        return redirect()->route('admin.product-categories.index')
            ->with('success', 'Kategori produk berhasil diperbarui.');
    }

    public function destroy(ProductCategory $category)
    {
        if ($category->is_system) {
            return redirect()->back()
                ->with('error', 'Kategori sistem tidak dapat dihapus.');
        }

        if ($category->products()->exists()) {
            return redirect()->back()
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk.');
        }

        if ($category->image) Storage::disk('public')->delete($category->image);
        $category->delete();

        return redirect()->route('admin.product-categories.index')
            ->with('success', 'Kategori produk berhasil dihapus.');
    }
}
