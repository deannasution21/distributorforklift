<template>
    <PublicLayout>
        <Head title="Produk — Forklift & Material Handling" />

        <!-- Breadcrumb -->
        <div class="bg-white border-b border-gray-100">
            <div
                class="max-w-screen-xl mx-auto px-4 py-3 flex items-center gap-2 text-sm text-gray-400"
            >
                <a
                    href="/"
                    class="hover:text-orange-600 transition-colors duration-150"
                    >Home</a
                >
                <span>›</span>
                <a
                    v-if="activeCategory"
                    :href="route('products.index')"
                    class="hover:text-orange-600 transition-colors duration-150"
                    >Produk</a
                >
                <span v-else class="text-slate-600 font-medium">Produk</span>
                <template v-if="activeCategory">
                    <span>›</span>
                    <span
                        class="text-slate-600 font-medium truncate max-w-[200px] md:max-w-xs"
                    >
                        {{ activeCategory.name }}
                    </span>
                </template>
            </div>
        </div>

        <!-- ============================================================
             HERO SECTION — same structure as Page/Show.vue
        ============================================================ -->
        <section
            class="relative w-full bg-white overflow-hidden hero-section border-b border-b-gray-100"
        >
            <div class="w-full flex flex-col md:flex-row h-full">
                <!-- Col Left -->
                <div class="hero-left-col flex flex-col justify-center">
                    <div class="inline-flex items-center gap-2 mb-5">
                        <span class="w-6 h-0.5 bg-orange-600"></span>
                        <span
                            class="text-xs font-bold text-orange-600 uppercase tracking-widest"
                        >
                            {{ hero?.label ?? "Produk" }}
                        </span>
                    </div>
                    <h1
                        class="text-3xl lg:text-4xl xl:text-[2.6rem] font-bold text-slate-900 leading-tight mb-4"
                    >
                        {{ hero?.name ?? "Produk" }}
                    </h1>
                    <p
                        v-if="hero?.description"
                        class="lg:text-2xl text-slate-500 leading-relaxed"
                    >
                        {{ hero.description }}
                    </p>
                </div>

                <!-- Col Right -->
                <div
                    class="hero-right-col overflow-hidden bg-gray-100 relative"
                >
                    <img
                        v-if="hero?.image"
                        :src="hero.image"
                        :alt="hero.name"
                        class="w-full h-full object-cover"
                    />
                    <div
                        v-else
                        class="w-full h-full flex items-center justify-center"
                    >
                        <svg
                            class="w-16 h-16 text-gray-200"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================
             PRODUK LIST — Side filter + cards grid
        ============================================================ -->
        <section id="produk-list" class="bg-gray-50 py-16">
            <div class="max-w-screen-xl mx-auto px-4">
                <div class="produk-layout">
                    <!-- ── Side Filter ──────────────────────────────── -->
                    <aside class="produk-filter">
                        <div class="overflow-hidden sticky top-6">
                            <!-- Filter header -->
                            <div class="flex items-center gap-3 mb-5">
                                <div
                                    class="w-8 h-8 rounded-full flex items-center justify-center shrink-0"
                                    style="background: #f2f2f2"
                                >
                                    <svg
                                        class="w-4 h-4 text-slate-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.75"
                                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"
                                        />
                                    </svg>
                                </div>
                                <span class="text-xl font-medium text-slate-600"
                                    >Filter</span
                                >
                            </div>

                            <!-- ① Kategori -->
                            <div class="border-b border-white">
                                <button
                                    @click="toggleFilter('category')"
                                    class="filter-group-header"
                                >
                                    <div class="flex items-center gap-2">
                                        <svg
                                            class="w-5 h-5 text-slate-500"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.75"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"
                                            />
                                        </svg>
                                        <span
                                            class="text-lg font-bold text-slate-700"
                                            >Kategori</span
                                        >
                                    </div>
                                    <div class="filter-toggle-btn">
                                        {{ openFilters.category ? "−" : "+" }}
                                    </div>
                                </button>
                                <div
                                    v-if="openFilters.category"
                                    class="px-4 py-3 space-y-1"
                                >
                                    <Link
                                        :href="route('products.index')"
                                        class="filter-checkbox-row text-sm py-1"
                                        :class="
                                            !activeCategory
                                                ? 'font-semibold text-orange-600'
                                                : 'text-slate-600'
                                        "
                                    >
                                        Semua Produk
                                    </Link>
                                    <Link
                                        v-for="cat in categories"
                                        :key="cat.id"
                                        :href="
                                            route('products.category', cat.slug)
                                        "
                                        class="filter-checkbox-row text-sm py-1"
                                        :class="
                                            activeCategory?.slug === cat.slug
                                                ? 'font-semibold text-orange-600'
                                                : 'text-slate-600'
                                        "
                                    >
                                        {{ cat.name }}
                                    </Link>
                                </div>
                            </div>

                            <!-- ② Kapasitas Angkat -->
                            <div class="border-b border-white">
                                <button
                                    @click="toggleFilter('capacity')"
                                    class="filter-group-header"
                                >
                                    <div class="flex items-center gap-2">
                                        <svg
                                            class="w-5 h-5 text-slate-500"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.75"
                                                d="M12 3a3 3 0 00-3 3v1H6a1 1 0 00-1 1v11a2 2 0 002 2h10a2 2 0 002-2V8a1 1 0 00-1-1h-3V6a3 3 0 00-3-3z"
                                            />
                                        </svg>
                                        <span
                                            class="text-lg font-bold text-slate-700"
                                            >Kapasitas Angkat (kg)</span
                                        >
                                    </div>
                                    <div class="filter-toggle-btn">
                                        {{ openFilters.capacity ? "−" : "+" }}
                                    </div>
                                </button>
                                <div
                                    v-if="openFilters.capacity"
                                    class="px-4 pb-4"
                                >
                                    <input
                                        type="range"
                                        min="500"
                                        max="8000"
                                        v-model="capacityVal"
                                        class="filter-slider w-full mb-3"
                                    />
                                    <div class="flex gap-2">
                                        <div class="filter-input-box">
                                            <span class="filter-input-label"
                                                >min</span
                                            >
                                            <input
                                                type="number"
                                                placeholder="500"
                                                class="filter-input"
                                            />
                                            <span class="filter-input-unit"
                                                >kg</span
                                            >
                                        </div>
                                        <div class="filter-input-box">
                                            <span class="filter-input-label"
                                                >max</span
                                            >
                                            <input
                                                type="number"
                                                placeholder="8000"
                                                class="filter-input"
                                            />
                                            <span class="filter-input-unit"
                                                >kg</span
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ② Tinggi Angkat -->
                            <div class="border-b border-white">
                                <button
                                    @click="toggleFilter('liftHeight')"
                                    class="filter-group-header"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg
                                            class="w-5 h-5 text-slate-500"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.75"
                                                d="M5 3v18M19 3v18M5 12h14"
                                            />
                                        </svg>
                                        <span
                                            class="text-lg font-bold text-slate-700"
                                            >Tinggi Angkat (mm)</span
                                        >
                                    </div>
                                    <div class="filter-toggle-btn">
                                        {{ openFilters.liftHeight ? "−" : "+" }}
                                    </div>
                                </button>
                                <div
                                    v-if="openFilters.liftHeight"
                                    class="px-4 pb-4"
                                >
                                    <input
                                        type="range"
                                        min="1000"
                                        max="12000"
                                        v-model="liftHeightVal"
                                        class="filter-slider w-full mb-3"
                                    />
                                    <div class="flex gap-2">
                                        <div class="filter-input-box flex-1">
                                            <span class="filter-input-label"
                                                >min</span
                                            >
                                            <input
                                                type="number"
                                                placeholder="1000"
                                                class="filter-input"
                                            />
                                            <span class="filter-input-unit"
                                                >mm</span
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ③ Jenis Kendali -->
                            <div class="border-b border-white">
                                <button
                                    @click="toggleFilter('control')"
                                    class="filter-group-header"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg
                                            class="w-5 h-5 text-slate-500"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.75"
                                                d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7"
                                            />
                                        </svg>
                                        <span
                                            class="text-lg font-bold text-slate-700"
                                            >Jenis Kendali</span
                                        >
                                    </div>
                                    <div class="filter-toggle-btn">
                                        {{ openFilters.control ? "−" : "+" }}
                                    </div>
                                </button>
                                <div
                                    v-if="openFilters.control"
                                    class="px-4 py-4 space-y-2.5"
                                >
                                    <label
                                        v-for="opt in controlOptions"
                                        :key="opt"
                                        class="filter-checkbox-row"
                                    >
                                        <input
                                            type="checkbox"
                                            v-model="selectedControls"
                                            :value="opt"
                                            class="filter-checkbox"
                                        />
                                        <span class="text-sm text-slate-600">{{
                                            opt
                                        }}</span>
                                    </label>
                                </div>
                            </div>

                            <!-- ④ Jenis Aplikasi -->
                            <div class="border-b border-white">
                                <button
                                    @click="toggleFilter('application')"
                                    class="filter-group-header"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg
                                            class="w-5 h-5 text-slate-500"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.75"
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                            />
                                        </svg>
                                        <span
                                            class="text-lg font-bold text-slate-700"
                                            >Jenis Aplikasi</span
                                        >
                                    </div>
                                    <div class="filter-toggle-btn">
                                        {{
                                            openFilters.application ? "−" : "+"
                                        }}
                                    </div>
                                </button>
                                <div
                                    v-if="openFilters.application"
                                    class="px-4 py-4 space-y-2.5"
                                >
                                    <label
                                        v-for="opt in applicationOptions"
                                        :key="opt"
                                        class="filter-checkbox-row"
                                    >
                                        <input
                                            type="checkbox"
                                            v-model="selectedApplications"
                                            :value="opt"
                                            class="filter-checkbox"
                                        />
                                        <span class="text-sm text-slate-600">{{
                                            opt
                                        }}</span>
                                    </label>
                                </div>
                            </div>

                            <!-- ⑤ Intensitas Penggunaan -->
                            <div>
                                <button
                                    @click="toggleFilter('intensity')"
                                    class="filter-group-header"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg
                                            class="w-5 h-5 text-slate-500"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.75"
                                                d="M13 10V3L4 14h7v7l9-11h-7z"
                                            />
                                        </svg>
                                        <span
                                            class="text-lg font-bold text-slate-700"
                                            >Intensitas Penggunaan</span
                                        >
                                    </div>
                                    <div class="filter-toggle-btn">
                                        {{ openFilters.intensity ? "−" : "+" }}
                                    </div>
                                </button>
                                <div
                                    v-if="openFilters.intensity"
                                    class="px-4 py-4 space-y-2.5"
                                >
                                    <label
                                        v-for="opt in intensityOptions"
                                        :key="opt"
                                        class="filter-checkbox-row"
                                    >
                                        <input
                                            type="checkbox"
                                            v-model="selectedIntensities"
                                            :value="opt"
                                            class="filter-checkbox"
                                        />
                                        <span class="text-sm text-slate-600">{{
                                            opt
                                        }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </aside>

                    <!-- ── Products Grid ─────────────────────────────── -->
                    <div class="produk-grid-wrapper">
                        <!-- Count -->
                        <p class="lg:text-xl text-slate-500 mb-6">
                            <span
                                v-if="activeCategory"
                                class="font-semibold text-slate-700"
                                >{{ activeCategory.name }}</span
                            >
                            <template v-if="activeCategory"> — </template>
                            <span class="font-semibold text-slate-700"
                                >{{ displayProducts.length }} produk</span
                            >
                            ditemukan
                        </p>

                        <!-- Grid -->
                        <div class="produk-grid gap-6">
                            <Link
                                v-for="product in displayProducts"
                                :key="product.id"
                                :href="
                                    route('products.show', [
                                        product.category_slug,
                                        product.slug,
                                    ])
                                "
                                class="overflow-hidden transition-all duration-200 group flex flex-col"
                            >
                                <!-- Image -->
                                <div
                                    class="relative bg-gray-50 flex items-center justify-center h-68 overflow-hidden"
                                >
                                    <img
                                        :src="product.image ?? '/static/placeholder-produk.webp'"
                                        :alt="product.name"
                                        class="h-full object-contain group-hover:scale-105 transition-transform duration-500"
                                    />
                                </div>

                                <!-- Specs strip (dynamic, up to 3 specs) -->
                                <div
                                    v-if="product.specs && product.specs.length"
                                    class="flex items-stretch border-t border-gray-100 gap-x-2 py-4"
                                >
                                    <template
                                        v-for="(spec, i) in product.specs.slice(
                                            0,
                                            3,
                                        )"
                                        :key="i"
                                    >
                                        <div
                                            v-if="i > 0"
                                            class="w-px bg-gray-300 flex-shrink-0 mx-1"
                                        ></div>
                                        <div
                                            class="flex flex-col items-center gap-y-1 justify-center flex-1"
                                        >
                                            <svg
                                                class="w-5 h-5 text-slate-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.75"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                                />
                                            </svg>
                                            <span
                                                class="text-[11px] text-slate-500 text-center leading-tight"
                                                >{{ spec.value }}</span
                                            >
                                            <span
                                                class="text-[10px] text-slate-400 text-center leading-tight"
                                                >{{ spec.label }}</span
                                            >
                                        </div>
                                    </template>
                                </div>

                                <!-- Name & CTA -->
                                <div
                                    class="py-4 border-b-2 border-gray-300 mt-auto"
                                >
                                    <h3
                                        class="text-2xl font-bold text-slate-600 mb-2 leading-snug"
                                    >
                                        {{ product.name }}
                                    </h3>
                                    <span
                                        class="inline-flex items-center gap-1 lg:text-xl font-semibold text-orange-600 group-hover:gap-2 transition-all duration-200"
                                    >
                                        Selengkapnya
                                    </span>
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Inquiry Section -->
        <InquirySection v-if="hero?.show_inquiry ?? true" />
    </PublicLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import PublicLayout from "@/Layouts/PublicLayout.vue";
import InquirySection from "@/Components/Public/InquirySection.vue";

const props = defineProps({
    categories: { type: Array, default: () => [] },
    products: { type: Array, default: () => [] },
    activeCategory: { type: Object, default: null },
    hero: { type: Object, default: null },
});

// ── Filter state ─────────────────────────────────────────────────
const openFilters = ref({
    category: true,
    capacity: false,
    liftHeight: false,
    control: false,
    application: false,
    intensity: false,
});
function toggleFilter(key) {
    openFilters.value[key] = !openFilters.value[key];
}

const capacityVal = ref(4000);
const liftHeightVal = ref(5000);
const selectedControls = ref([]);
const selectedApplications = ref([]);
const selectedIntensities = ref([]);

const controlOptions = ["Duduk (Seated)", "Berdiri (Standing)"];
const applicationOptions = [
    "Loading/unloading dock",
    "Loading/unloading over the side",
];
const intensityOptions = ["Tinggi (High)", "Rendah (Low)"];

const displayProducts = computed(() => props.products);
</script>

<style scoped>
/* ── Hero responsive layout (sama persis dengan Page/Show.vue) ── */
.hero-section {
    height: 560px;
}

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
    .hero-section {
        height: 510px;
    }

    .hero-left-col {
        width: 45%;
        flex-shrink: 0;
        padding-top: 0;
        padding-bottom: 0;
        padding-right: 3rem;
        padding-left: max(calc((100vw - 80rem) / 2 + 1.5rem), 1.5rem);
    }

    .hero-right-col {
        flex: 1;
        height: auto;
    }
}

/* ── Filter components ────────────────────────────────────────── */
.filter-group-header {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem 1rem;
    background: #f2f2f2;
    cursor: pointer;
    transition: background 0.15s;
}
.filter-group-header:hover {
    background: #f3f4f6;
}

.filter-toggle-btn {
    width: 1.25rem;
    height: 1.25rem;
    border-radius: 50%;
    background: #969492;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    font-weight: 500;
    color: #fff;
    line-height: 1;
    flex-shrink: 0;
}

.filter-slider {
    -webkit-appearance: none;
    appearance: none;
    width: 100%;
    height: 2px;
    background: #e2e8f0;
    outline: none;
    border-radius: 1px;
    margin-top: 0.5rem;
}
.filter-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 14px;
    height: 22px;
    background: #ea580c;
    cursor: pointer;
    border-radius: 2px;
}
.filter-slider::-moz-range-thumb {
    width: 14px;
    height: 22px;
    background: #ea580c;
    cursor: pointer;
    border-radius: 2px;
    border: none;
}

.filter-input-box {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    /* border: 1px solid #e5e7eb; */
    border-radius: 0.25rem;
    padding: 0.375rem 0.5rem;
    flex: 1;
}
.filter-input-label {
    font-size: 10px;
    color: #9ca3af;
}
.filter-input-unit {
    font-size: 10px;
    color: #9ca3af;
}
.filter-input {
    width: 100%;
    font-size: 0.75rem;
    color: #1e293b;
    outline: none;
    background: transparent;
    min-width: 0;
}

.filter-checkbox-row {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
}
.filter-checkbox {
    width: 1rem;
    height: 1rem;
    border: 1px solid #d1d5db;
    border-radius: 2px;
    cursor: pointer;
    accent-color: #ea580c;
    flex-shrink: 0;
}

/* ── Produk layout ────────────────────────────────────────────── */
.produk-layout {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.produk-filter {
    width: 100%;
    flex-shrink: 0;
}

.produk-grid-wrapper {
    flex: 1;
    min-width: 0;
}

.produk-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}

@media (min-width: 640px) {
    .produk-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .produk-layout {
        flex-direction: row;
    }

    .produk-filter {
        width: 280px;
    }

    .produk-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}
</style>
