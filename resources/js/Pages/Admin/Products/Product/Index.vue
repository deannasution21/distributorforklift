<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

defineProps({
    products: { type: Array, default: () => [] },
});

function destroy(id) {
    if (!confirm("Hapus produk ini?")) return;
    router.delete(route("admin.products.destroy", id));
}
</script>

<template>
    <Head title="Produk" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-2">
                <span class="text-xs text-slate-400">Produk</span>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-xs font-semibold text-slate-700">Daftar Produk</span>
            </div>
        </template>

        <div class="max-w-5xl mx-auto">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h1 class="text-lg font-black text-slate-900">Daftar Produk</h1>
                    <p class="text-xs text-slate-400 mt-0.5">Kelola produk katalog yang ditampilkan di website.</p>
                </div>
                <div class="flex items-center gap-3">
                    <Link :href="route('admin.product-categories.index')"
                        class="inline-flex items-center gap-2 border border-gray-200 hover:border-orange-400 text-slate-600 hover:text-orange-600 text-sm font-semibold px-4 py-2.5 rounded transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H7m6 6l-6-6 6-6" />
                        </svg>
                        Kategori
                    </Link>
                    <Link :href="route('admin.products.create')"
                        class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white text-sm font-bold px-5 py-2.5 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Produk
                    </Link>
                </div>
            </div>

            <!-- Empty -->
            <div v-if="!products.length"
                class="bg-white border border-gray-100 rounded-lg p-12 text-center">
                <p class="text-slate-400 text-sm">Belum ada produk. Tambahkan yang pertama.</p>
            </div>

            <!-- Table -->
            <div v-else class="bg-white border border-gray-100 rounded-lg overflow-hidden">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50">
                            <th class="text-left px-4 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider w-16">Foto</th>
                            <th class="text-left px-4 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Produk</th>
                            <th class="text-left px-4 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Kategori</th>
                            <th class="text-left px-4 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">URL</th>
                            <th class="text-left px-4 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 w-32"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <tr v-for="p in products" :key="p.id" class="hover:bg-gray-50/50 transition-colors">
                            <!-- Thumbnail -->
                            <td class="px-4 py-3">
                                <div class="w-12 h-12 rounded border border-gray-100 overflow-hidden bg-gray-50 flex items-center justify-center">
                                    <img v-if="p.image" :src="p.image" :alt="p.name"
                                        class="w-full h-full object-cover" />
                                    <svg v-else class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </td>
                            <!-- Name -->
                            <td class="px-4 py-3">
                                <span class="font-semibold text-slate-900">{{ p.name }}</span>
                            </td>
                            <!-- Category -->
                            <td class="px-4 py-3 text-slate-500 text-xs">{{ p.category_name ?? "—" }}</td>
                            <!-- URL -->
                            <td class="px-4 py-3">
                                <code class="text-[11px] bg-gray-50 px-1.5 py-0.5 rounded text-slate-400">
                                    /produk/{{ p.category_slug }}/{{ p.slug }}
                                </code>
                            </td>
                            <!-- Status -->
                            <td class="px-4 py-3">
                                <span :class="p.is_active
                                    ? 'bg-green-50 text-green-700'
                                    : 'bg-gray-100 text-gray-400'"
                                    class="text-[10px] font-semibold px-2 py-0.5 rounded-full">
                                    {{ p.is_active ? "Aktif" : "Nonaktif" }}
                                </span>
                            </td>
                            <!-- Actions -->
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2 justify-end">
                                    <Link :href="route('admin.products.edit', p.id)"
                                        class="inline-flex items-center gap-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-bold px-3 py-1.5 rounded transition-colors duration-150">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </Link>
                                    <button @click="destroy(p.id)"
                                        class="inline-flex items-center gap-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-3 py-1.5 rounded transition-colors duration-150">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
