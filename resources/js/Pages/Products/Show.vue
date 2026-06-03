<template>
    <PublicLayout>
        <Head :title="product.name + ' — Produk'" />

        <!-- Breadcrumb -->
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-screen-xl mx-auto px-4 py-3 flex items-center gap-2 text-sm text-gray-400">
                <a href="/" class="hover:text-orange-600 transition-colors duration-150">Home</a>
                <span>›</span>
                <a :href="route('products.index')" class="hover:text-orange-600 transition-colors duration-150">Produk</a>
                <span>›</span>
                <a :href="route('products.category', category.slug)"
                    class="hover:text-orange-600 transition-colors duration-150">{{ category.name }}</a>
                <span>›</span>
                <span class="text-slate-600 font-medium truncate max-w-[200px] md:max-w-xs">{{ product.name }}</span>
            </div>
        </div>

        <!-- Hero -->
        <section class="relative w-full bg-white overflow-hidden hero-section border-b border-gray-100">
            <div class="w-full flex flex-col md:flex-row h-full">
                <!-- Left: Text -->
                <div class="hero-left-col flex flex-col justify-center">
                    <div class="inline-flex items-center gap-2 mb-4">
                        <span class="w-6 h-0.5 bg-orange-600"></span>
                        <span class="text-xs font-bold text-orange-600 uppercase tracking-widest">
                            {{ category.name }}
                        </span>
                    </div>
                    <h1 class="text-3xl lg:text-4xl xl:text-[2.6rem] font-bold text-slate-900 leading-tight mb-4">
                        {{ product.name }}
                    </h1>
                    <p v-if="product.short_description" class="lg:text-xl text-slate-500 leading-relaxed mb-8">
                        {{ product.short_description }}
                    </p>
                    <div class="flex items-center gap-3 flex-wrap">
                        <a href="#inquiry"
                            class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white md:text-lg font-bold px-6 py-3 transition-colors duration-200">
                            Minta Penawaran
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        <a :href="route('products.category', category.slug)"
                            class="inline-flex items-center gap-2 border border-gray-200 hover:border-orange-400 text-slate-600 hover:text-orange-600 md:text-lg font-semibold px-6 py-3 transition-colors duration-200">
                            ← Kembali
                        </a>
                    </div>
                </div>
                <!-- Right: Image -->
                <div class="hero-right-col overflow-hidden bg-gray-50 relative flex items-center justify-center">
                    <img v-if="product.image" :src="product.image" :alt="product.name"
                        class="w-full h-full object-contain p-6" />
                    <svg v-else class="w-24 h-24 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </section>

        <!-- Specs Table -->
        <section v-if="product.specs && product.specs.length" class="bg-white py-14 border-b border-gray-100">
            <div class="max-w-screen-xl mx-auto px-4">
                <div class="inline-flex items-center gap-2 mb-6">
                    <span class="w-6 h-0.5 bg-orange-600"></span>
                    <span class="text-xs font-bold text-orange-600 uppercase tracking-widest">Spesifikasi</span>
                </div>
                <div class="max-w-2xl">
                    <table class="w-full text-sm">
                        <tbody>
                            <tr v-for="(spec, i) in product.specs" :key="i"
                                class="border-b border-gray-100 last:border-0">
                                <td class="py-3 pr-8 text-slate-500 font-medium w-2/5">{{ spec.label }}</td>
                                <td class="py-3 text-slate-800 font-semibold">{{ spec.value }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Full Description -->
        <section v-if="product.full_description" class="bg-white py-14 border-b border-gray-100">
            <div class="max-w-screen-xl mx-auto px-4">
                <div class="inline-flex items-center gap-2 mb-6">
                    <span class="w-6 h-0.5 bg-orange-600"></span>
                    <span class="text-xs font-bold text-orange-600 uppercase tracking-widest">Deskripsi</span>
                </div>
                <div class="max-w-3xl product-content" v-html="product.full_description"></div>
            </div>
        </section>

        <!-- Inquiry -->
        <InquirySection id="inquiry" />
    </PublicLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import PublicLayout from "@/Layouts/PublicLayout.vue";
import InquirySection from "@/Components/Public/InquirySection.vue";

defineProps({
    product:  { type: Object, required: true },
    category: { type: Object, required: true },
});
</script>

<style scoped>
.hero-section { height: 560px; }
.hero-left-col {
    width: 100%;
    padding: 2.5rem 1.5rem 2rem;
}
.hero-right-col {
    width: 100%;
    height: 240px;
    flex-shrink: 0;
}
@media (min-width: 768px) {
    .hero-section { height: 510px; }
    .hero-left-col {
        width: 45%;
        flex-shrink: 0;
        padding-top: 0;
        padding-bottom: 0;
        padding-right: 3rem;
        padding-left: max(calc((100vw - 80rem) / 2 + 1.5rem), 1.5rem);
    }
    .hero-right-col { flex: 1; height: auto; }
}

.product-content :deep(p) { color: #475569; line-height: 1.8; margin-bottom: 1.25rem; font-size: 1rem; }
@media (min-width: 768px) { .product-content :deep(p) { font-size: 1.125rem; } }
.product-content :deep(h2) { font-size: 1.75rem; font-weight: 800; color: #0f172a; margin: 2.5rem 0 1rem; }
.product-content :deep(h3) { font-size: 1.25rem; font-weight: 700; color: #1e293b; margin: 2rem 0 0.75rem; }
.product-content :deep(ul) { padding-left: 1.5rem; color: #475569; line-height: 1.8; margin-bottom: 1.25rem; list-style: disc; }
.product-content :deep(li) { margin-bottom: 0.5rem; font-size: 1rem; }
.product-content :deep(strong) { font-weight: 700; color: #1e293b; }
</style>
