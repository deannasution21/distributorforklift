<template>
    <header class="w-full z-50 fixed top-0 left-0">
        <!-- ── Top Bar ──────────────────────────────────────────────── -->
        <div
            class="bg-white border-t-[5px] border-t-orange-600 border-b border-b-gray-200"
        >
            <div
                class="max-w-screen-xl mx-auto md:px-6 flex items-center justify-center gap-0 h-9"
            >
                <!-- Berita & Artikel — desktop only -->
                <a
                    :href="route('news.index')"
                    class="hidden lg:flex items-center gap-1.5 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-150 px-4 h-full border-r border-gray-200"
                >
                    <svg
                        class="w-3.5 h-3.5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"
                        />
                    </svg>
                    Berita & Artikel
                </a>

                <!-- Phone -->
                <a
                    v-if="topBarPhone"
                    :href="topBarPhoneHref"
                    class="flex items-center gap-1.5 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-150 px-3 lg:px-4 h-full border-r border-gray-200"
                >
                    <svg
                        class="w-3.5 h-3.5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                        />
                    </svg>
                    {{ topBarPhone }}
                </a>

                <!-- WhatsApp -->
                <a
                    v-if="topBarWaHref"
                    :href="topBarWaHref"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="flex items-center gap-1.5 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-150 px-3 lg:px-4 h-full lg:border-r border-gray-200"
                >
                    <svg
                        class="w-3.5 h-3.5"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"
                        />
                    </svg>
                    WhatsApp
                </a>

                <!-- Lokasi & Kontak -->
                <a
                    :href="route('contact.show')"
                    class="flex items-center gap-1.5 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-150 px-3 lg:px-4 h-full border-l border-gray-200"
                >
                    <svg
                        class="w-3.5 h-3.5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>
                    Lokasi & Kontak
                </a>
            </div>
        </div>

        <!-- ── Main Navigation ───────────────────────────────────────── -->
        <nav class="bg-white border-b border-gray-200 shadow-sm">
            <div
                class="max-w-screen-xl mx-auto px-6 flex items-center h-[68px]"
            >
                <!-- Logo -->
                <a
                    href="/"
                    class="flex items-center gap-2.5 flex-shrink-0 mr-10"
                >
                    <div
                        class="w-8 h-8 bg-orange-600 flex items-center justify-center"
                    >
                        <svg
                            class="w-5 h-5 text-white"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path d="M1 3h15v13H1zM16 8h4l3 3v5h-7V8z" />
                        </svg>
                    </div>
                    <span
                        class="font-black text-slate-900 text-[17px] tracking-tight leading-none"
                    >
                        DISTRIBUTOR<span class="text-orange-600">FORKLIFT</span>
                    </span>
                </a>

                <!-- Desktop Nav Items -->
                <div
                    class="hidden lg:flex items-stretch justify-center flex-1 h-full"
                >
                    <div
                        v-for="item in navItems"
                        :key="item.label"
                        class="relative flex items-stretch"
                        @mouseenter="openMenu(item)"
                        @mouseleave="scheduleClose"
                    >
                        <component
                            :is="item.href ? 'a' : 'button'"
                            :href="item.href ?? undefined"
                            :class="[
                                'flex items-center gap-1 px-4 text-lg transition-colors duration-150 whitespace-nowrap border-b-[3px] -mb-px h-full',
                                activeMenu === item.label
                                    ? 'text-orange-600 border-orange-600 font-bold'
                                    : 'text-slate-800 border-transparent hover:text-orange-600 font-bold',
                            ]"
                        >
                            {{ item.label }}
                            <svg
                                v-if="item.subItems"
                                class="w-3 h-3 transition-transform duration-200"
                                :class="{
                                    'rotate-180': activeMenu === item.label,
                                }"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2.5"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </component>
                    </div>
                </div>

                <!-- Shop / CTA Button -->
                <a
                    href="/products"
                    class="hidden lg:flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white text-sm font-semibold px-5 py-2.5 transition-colors duration-200 ml-4 flex-shrink-0"
                >
                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16"
                        />
                    </svg>
                    Katalog
                </a>

                <!-- Mobile Hamburger -->
                <button
                    @click="mobileOpen = !mobileOpen"
                    class="lg:hidden ml-auto p-2 text-slate-700 hover:text-orange-600 transition-colors"
                >
                    <svg
                        v-if="!mobileOpen"
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                    <svg
                        v-else
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
        </nav>

        <!-- ── Mega Menu Dropdown ────────────────────────────────────── -->
        <div
            v-if="activeMenu && activeMegaData"
            class="bg-white border-b border-gray-200 shadow-lg"
            @mouseenter="cancelClose"
            @mouseleave="scheduleClose"
        >
            <div class="max-w-screen-xl mx-auto px-6 py-7 flex gap-0 relative">
                <!-- Left Panel: Sub-categories (orange) -->
                <div class="w-64 flex-shrink-0 border-r border-gray-100 pr-6">
                    <button
                        v-for="sub in activeMegaData.subItems"
                        :key="sub.label"
                        @mouseenter="activeSubItem = sub.label"
                        :class="[
                            'flex items-center justify-between w-full text-left px-3 py-2.5 text-xl rounded transition-colors duration-150',
                            activeSubItem === sub.label
                                ? 'text-orange-600 font-semibold bg-orange-50'
                                : 'text-orange-500 hover:text-orange-700 font-medium',
                        ]"
                    >
                        <span>{{ sub.label }}</span>
                        <svg
                            v-if="sub.children"
                            class="w-3.5 h-3.5 flex-shrink-0 ml-2"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2.5"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>
                    </button>
                </div>

                <!-- Right Panel: Children of hovered sub-item -->
                <div class="flex-1 pl-10">
                    <template
                        v-if="activeSubItemData && activeSubItemData.children"
                    >
                        <h3 class="text-orange-600 font-semibold text-xl mb-4">
                            {{ activeSubItemData.label }}
                        </h3>
                        <div class="grid grid-cols-2 gap-x-12 gap-y-1">
                            <a
                                v-for="child in activeSubItemData.children"
                                :key="child.label"
                                :href="child.href ?? '#'"
                                class="text-lg text-gray-500 hover:text-orange-600 py-1.5 transition-colors duration-150"
                            >
                                {{ child.label }}
                            </a>
                        </div>
                    </template>
                    <template
                        v-else-if="
                            activeSubItemData && !activeSubItemData.children
                        "
                    >
                        <h3 class="text-orange-600 font-semibold text-xl mb-4">
                            {{ activeSubItemData.label }}
                        </h3>
                        <p class="text-lg text-gray-400">
                            Pilih kategori di sebelah kiri untuk melihat detail.
                        </p>
                    </template>
                    <template v-else>
                        <p class="text-lg text-gray-400 pt-2">
                            Arahkan kursor ke kategori di kiri.
                        </p>
                    </template>
                </div>

                <!-- Close Button -->
                <button
                    @click="
                        activeMenu = null;
                        activeSubItem = null;
                    "
                    class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-gray-400 hover:text-orange-600 transition-colors duration-150"
                    aria-label="Tutup menu"
                >
                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
        </div>

        <!-- ── Mobile Menu ───────────────────────────────────────────── -->
        <div
            v-if="mobileOpen"
            class="lg:hidden bg-white border-b border-gray-200 shadow-lg max-h-[80vh] overflow-y-auto"
        >
            <div class="max-w-screen-xl mx-auto px-4 py-3">
                <div
                    v-for="item in navItems"
                    :key="item.label"
                    class="border-b border-gray-50 last:border-0"
                >
                    <component
                        :is="item.href ? 'a' : 'button'"
                        :href="item.href ?? undefined"
                        @click="item.href ? null : toggleMobileItem(item.label)"
                        class="flex items-center justify-between w-full py-3.5 font-bold text-lg text-slate-700 hover:text-orange-600 transition-colors"
                    >
                        <span>{{ item.label }}</span>
                        <svg
                            v-if="item.subItems"
                            class="w-4 h-4 transition-transform"
                            :class="{
                                'rotate-180': mobileExpanded === item.label,
                            }"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </component>

                    <!-- Mobile sub-items -->
                    <div
                        v-if="item.subItems && mobileExpanded === item.label"
                        class="pl-4 pb-3 space-y-1"
                    >
                        <div v-for="sub in item.subItems" :key="sub.label">
                            <button
                                @click="toggleMobileSubItem(sub.label)"
                                class="flex items-center justify-between w-full py-2 text-lg text-orange-500 hover:text-orange-700 font-medium transition-colors"
                            >
                                <span>{{ sub.label }}</span>
                                <svg
                                    v-if="sub.children"
                                    class="w-3.5 h-3.5 transition-transform"
                                    :class="{
                                        'rotate-90':
                                            mobileSubExpanded === sub.label,
                                    }"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </button>
                            <div
                                v-if="
                                    sub.children &&
                                    mobileSubExpanded === sub.label
                                "
                                class="pl-4 space-y-1 pb-1"
                            >
                                <a
                                    v-for="child in sub.children"
                                    :key="child.label"
                                    :href="child.href ?? '#'"
                                    class="block py-1.5 text-gray-500 hover:text-orange-600 transition-colors"
                                >
                                    {{ child.label }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 pb-3 flex flex-col gap-2.5">
                    <a
                        href="/products"
                        class="bg-orange-600 text-white text-lg font-semibold px-5 py-3 text-center hover:bg-orange-700 transition-colors"
                    >
                        Katalog Produk
                    </a>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const sharedNavPages = computed(() => usePage().props.nav_pages ?? []);
const navStructure = computed(() => usePage().props.nav_structure ?? []);

const siteSettings = computed(() => usePage().props.site_settings ?? {});
const topBarPhone = computed(() => siteSettings.value.phone || null);
const topBarPhoneHref = computed(() =>
    topBarPhone.value
        ? `tel:${topBarPhone.value.replace(/[\s\-\(\)]/g, "")}`
        : null,
);
const topBarWaHref = computed(() => {
    const wa = siteSettings.value.whatsapp;
    return wa ? `https://wa.me/${wa}` : null;
});

const activeMenu = ref(null);
const activeSubItem = ref(null);
const mobileOpen = ref(false);
const mobileExpanded = ref(null);
const mobileSubExpanded = ref(null);
let closeTimer = null;

// ── Nav Data ────────────────────────────────────────────────────
// children[] are objects: { label, href } — href null means no link yet
const baseNavItems = [
    {
        label: "Produk",
        subItems: [
            {
                label: "Forklift Baru",
                children: [
                    { label: "Forklift Elektrik", href: null },
                    { label: "Forklift Diesel", href: null },
                    { label: "Forklift LPG", href: null },
                    { label: "Forklift 4 Roda", href: null },
                    { label: "Forklift 3 Roda", href: null },
                    { label: "Forklift Heavy Duty", href: null },
                ],
            },
            {
                label: "Forklift Sewa",
                children: [
                    { label: "Sewa Harian", href: null },
                    { label: "Sewa Bulanan", href: null },
                    { label: "Sewa Tahunan", href: null },
                    { label: "Sewa dengan Operator", href: null },
                ],
            },
            {
                label: "Forklift Bekas",
                children: [
                    { label: "Unit Bekas Terinspeksi", href: null },
                    { label: "Garansi Terbatas", href: null },
                    { label: "Trade-In Program", href: null },
                ],
            },
            {
                label: "Reach Truck",
                children: [
                    { label: "Reach Truck Standar", href: null },
                    { label: "Double Deep Reach", href: null },
                    { label: "Narrow Aisle Reach", href: null },
                ],
            },
            {
                label: "Hand Pallet & Order Picker",
                children: [
                    { label: "Hand Pallet Manual", href: null },
                    { label: "Hand Pallet Elektrik", href: null },
                    { label: "Low Level Order Picker", href: null },
                    { label: "High Level Order Picker", href: null },
                ],
            },
            {
                label: "Semua Produk",
                children: null,
            },
        ],
    },
    {
        label: "Solusi",
        subItems: [
            {
                label: "Gudang & Logistik",
                children: [
                    { label: "Penerimaan Barang", href: null },
                    { label: "Order Picking", href: null },
                    { label: "Pengemasan & Pengiriman", href: null },
                    { label: "Optimasi Storage", href: null },
                    { label: "Supply Produksi", href: null },
                    { label: "Barang Keluar", href: null },
                ],
            },
            {
                label: "Manufaktur",
                children: [
                    { label: "Lini Produksi", href: null },
                    { label: "Material Supply", href: null },
                    { label: "Pengangkutan Internal", href: null },
                    { label: "Waste Management", href: null },
                ],
            },
            {
                label: "Cold Storage",
                children: [
                    { label: "Forklift Suhu Rendah", href: null },
                    { label: "Freezer Warehouse", href: null },
                    { label: "Pharmaceutical Storage", href: null },
                ],
            },
            {
                label: "Retail & Distribusi",
                children: [
                    { label: "Cross Docking", href: null },
                    { label: "Sortasi & Distribusi", href: null },
                    { label: "Last-Mile Support", href: null },
                ],
            },
            {
                label: "Konstruksi & Berat",
                children: [
                    { label: "Forklift Outdoor", href: null },
                    { label: "Rough Terrain", href: null },
                    { label: "Heavy Load Solution", href: null },
                ],
            },
        ],
    },
    {
        label: "Layanan",
        subItems: [
            {
                label: "Perawatan & Servis",
                children: [
                    { label: "Servis Berkala", href: null },
                    { label: "Servis Darurat", href: null },
                    { label: "Perawatan Preventif", href: null },
                    { label: "Overhaul", href: null },
                ],
            },
            {
                label: "Suku Cadang",
                children: [
                    { label: "Suku Cadang Original", href: null },
                    { label: "Fast Moving Parts", href: null },
                    { label: "Pemesanan Online", href: null },
                ],
            },
            {
                label: "Pelatihan Operator",
                children: [
                    { label: "Sertifikasi Operator", href: null },
                    { label: "Safety Training", href: null },
                    { label: "In-House Training", href: null },
                ],
            },
            {
                label: "Konsultasi Teknis",
                children: [
                    { label: "Analisa Kebutuhan", href: null },
                    { label: "Fleet Management", href: null },
                    { label: "Konsultasi On-Site", href: null },
                ],
            },
        ],
    },
    {
        label: "Berita",
        href: route("news.index"),
        subItems: null,
    },
    {
        label: "Perusahaan",
        subItems: [
            {
                label: "Tentang Kami",
                children: [
                    { label: "Sejarah Perusahaan", href: null },
                    { label: "Visi & Misi", href: null },
                    { label: "Sertifikasi & Penghargaan", href: null },
                ],
            },
            {
                label: "Mitra & Merek",
                children: null,
            },
            {
                label: "Karir",
                children: [
                    { label: "Lowongan Kerja", href: null },
                    { label: "Budaya Kerja", href: null },
                    { label: "Benefit Karyawan", href: null },
                ],
            },
        ],
    },
    {
        label: "Kontak",
        subItems: null,
    },
];

const navItems = computed(() => {
    const base = navStructure.value.length ? navStructure.value : baseNavItems;

    if (!sharedNavPages.value.length) return base;

    return base.map((mainItem) => {
        if (!mainItem.subItems) return mainItem;

        const relevantPages = sharedNavPages.value.filter(
            (p) => p.nav_group === mainItem.label,
        );
        if (!relevantPages.length) return mainItem;

        const newSubItems = mainItem.subItems.map((sub) => {
            const pagesForSub = relevantPages.filter(
                (p) => p.nav_sub === sub.label,
            );
            if (!pagesForSub.length) return sub;

            const dynamicChildren = pagesForSub.map((p) => ({
                label: p.nav_label || p.slug,
                href: route("page.show", p.slug),
            }));

            return {
                ...sub,
                children: sub.children
                    ? [...sub.children, ...dynamicChildren]
                    : dynamicChildren,
            };
        });

        return { ...mainItem, subItems: newSubItems };
    });
});

// ── Computed ────────────────────────────────────────────────────
const activeMegaData = computed(
    () => navItems.value.find((i) => i.label === activeMenu.value) ?? null,
);

const activeSubItemData = computed(() => {
    if (!activeMegaData.value?.subItems || !activeSubItem.value) return null;
    return (
        activeMegaData.value.subItems.find(
            (s) => s.label === activeSubItem.value,
        ) ?? null
    );
});

// ── Desktop Menu Handlers ───────────────────────────────────────
function openMenu(item) {
    cancelClose();
    if (!item.subItems) {
        activeMenu.value = null;
        return;
    }
    activeMenu.value = item.label;
    activeSubItem.value = item.subItems[0]?.label ?? null;
}

function scheduleClose() {
    closeTimer = setTimeout(() => {
        activeMenu.value = null;
        activeSubItem.value = null;
    }, 120);
}

function cancelClose() {
    clearTimeout(closeTimer);
}

// ── Mobile Handlers ─────────────────────────────────────────────
function toggleMobileItem(label) {
    mobileExpanded.value = mobileExpanded.value === label ? null : label;
    mobileSubExpanded.value = null;
}

function toggleMobileSubItem(label) {
    mobileSubExpanded.value = mobileSubExpanded.value === label ? null : label;
}
</script>
