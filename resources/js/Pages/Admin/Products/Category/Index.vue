<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

defineProps({
    categories: { type: Array, default: () => [] },
});

function destroy(id) {
    if (!confirm("Hapus kategori ini? Pastikan tidak ada produk dalam kategori ini.")) return;
    router.delete(route("admin.product-categories.destroy", id));
}
</script>

<template>
    <Head title="Kategori Produk" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-2">
                <span class="text-xs text-slate-400">Produk</span>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-xs font-semibold text-slate-700">Kategori Produk</span>
            </div>
        </template>

        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h1 class="text-lg font-black text-slate-900">Kategori Produk</h1>
                    <p class="text-xs text-slate-400 mt-0.5">Kelola kategori produk. URL kategori digunakan pada menu navigasi.</p>
                </div>
                <Link :href="route('admin.product-categories.create')"
                    class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white text-sm font-bold px-5 py-2.5 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kategori
                </Link>
            </div>

            <!-- Empty -->
            <div v-if="!categories.length"
                class="bg-white border border-gray-100 rounded-lg p-12 text-center">
                <p class="text-slate-400 text-sm">Belum ada kategori produk. Tambahkan yang pertama.</p>
            </div>

            <!-- List -->
            <div v-else class="space-y-3">
                <div v-for="cat in categories" :key="cat.id"
                    class="bg-white border border-gray-100 rounded-lg p-4 flex items-center gap-4">

                    <!-- Image thumbnail -->
                    <div class="w-16 h-16 shrink-0 rounded border border-gray-100 overflow-hidden bg-gray-50 flex items-center justify-center">
                        <img v-if="cat.image" :src="'/storage/' + cat.image" :alt="cat.name"
                            class="w-full h-full object-cover" />
                        <svg v-else class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>

                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-sm font-bold text-slate-900">{{ cat.name }}</span>
                            <span v-if="cat.is_system"
                                class="text-[10px] font-semibold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">
                                Sistem
                            </span>
                            <span v-if="!cat.is_active && !cat.is_system"
                                class="text-[10px] font-semibold bg-gray-100 text-gray-400 px-2 py-0.5 rounded-full">
                                Nonaktif
                            </span>
                            <span class="text-[10px] font-semibold bg-orange-50 text-orange-600 px-2 py-0.5 rounded-full">
                                {{ cat.products_count }} produk
                            </span>
                        </div>
                        <p class="text-xs text-slate-400 mt-0.5">
                            URL:
                            <code v-if="cat.is_system" class="bg-gray-50 px-1 rounded text-slate-500">/produk</code>
                            <code v-else class="bg-gray-50 px-1 rounded text-slate-500">/produk/{{ cat.slug }}</code>
                        </p>
                        <p v-if="cat.description" class="text-xs text-slate-400 mt-0.5 truncate">{{ cat.description }}</p>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 shrink-0">
                        <!-- View on website: system → products.index, others → products.category -->
                        <a :href="cat.is_system ? route('products.index') : route('products.category', cat.slug)"
                            target="_blank"
                            class="inline-flex items-center gap-1.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold px-3 py-1.5 rounded transition-colors duration-150"
                            title="Lihat di website">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                        <Link :href="route('admin.product-categories.edit', cat.id)"
                            class="inline-flex items-center gap-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-bold px-3 py-1.5 rounded transition-colors duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </Link>
                        <button v-if="!cat.is_system" @click="destroy(cat.id)"
                            class="inline-flex items-center gap-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-3 py-1.5 rounded transition-colors duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
