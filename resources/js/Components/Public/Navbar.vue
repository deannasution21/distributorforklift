<template>
    <header class="w-full z-50 fixed top-0 left-0">
        <!-- ── Top Bar ──────────────────────────────────────────────── -->
        <div
            class="bg-white border-t-[5px] border-t-orange-600 border-b border-b-gray-200"
        >
            <div
                class="max-w-screen-xl mx-auto px-6 flex items-center justify-center gap-0 h-9"
            >
                <!-- Globe -->
                <button
                    class="flex items-center gap-1.5 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-150 px-3 h-full border-r border-gray-200"
                >
                    <svg
                        class="w-3.5 h-3.5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <circle cx="12" cy="12" r="10" stroke-width="1.5" />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"
                        />
                    </svg>
                    <span>Indonesia</span>
                    <svg
                        class="w-3 h-3"
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
                </button>

                <a
                    href="#"
                    class="text-xs text-gray-500 hover:text-orange-600 transition-colors duration-150 px-4 h-full flex items-center border-r border-gray-200"
                    >Pemberitahuan Keamanan</a
                >
                <a
                    href="#"
                    class="text-xs text-gray-500 hover:text-orange-600 transition-colors duration-150 px-4 h-full flex items-center border-r border-gray-200"
                    >UKMHA Release</a
                >

                <!-- Blog -->
                <a
                    href="#"
                    class="flex items-center gap-1.5 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-150 px-4 h-full border-r border-gray-200"
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
                    Blog
                </a>

                <!-- Phone -->
                <a
                    href="tel:+6221000000"
                    class="flex items-center gap-1.5 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-150 px-4 h-full border-r border-gray-200"
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
                    +62 21 000 0000
                </a>

                <!-- Locations -->
                <a
                    href="#"
                    class="flex items-center gap-1.5 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-150 px-4 h-full border-r border-gray-200"
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

                <!-- Search -->
                <button
                    class="flex items-center gap-1.5 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-150 px-4 h-full"
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
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>
                    Cari
                </button>
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
                        <button
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
                        </button>
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
                                :key="child"
                                href="#"
                                class="text-lg text-gray-500 hover:text-orange-600 py-1.5 transition-colors duration-150"
                            >
                                {{ child }}
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
                    <button
                        @click="toggleMobileItem(item.label)"
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
                    </button>

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
                                    :key="child"
                                    href="#"
                                    class="block py-1.5 text-gray-500 hover:text-orange-600 transition-colors"
                                >
                                    {{ child }}
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

const activeMenu = ref(null);
const activeSubItem = ref(null);
const mobileOpen = ref(false);
const mobileExpanded = ref(null);
const mobileSubExpanded = ref(null);
let closeTimer = null;

// ── Nav Data ────────────────────────────────────────────────────
const navItems = [
    {
        label: "Produk",
        subItems: [
            {
                label: "Forklift Baru",
                children: [
                    "Forklift Elektrik",
                    "Forklift Diesel",
                    "Forklift LPG",
                    "Forklift 4 Roda",
                    "Forklift 3 Roda",
                    "Forklift Heavy Duty",
                ],
            },
            {
                label: "Forklift Sewa",
                children: [
                    "Sewa Harian",
                    "Sewa Bulanan",
                    "Sewa Tahunan",
                    "Sewa dengan Operator",
                ],
            },
            {
                label: "Forklift Bekas",
                children: [
                    "Unit Bekas Terinspeksi",
                    "Garansi Terbatas",
                    "Trade-In Program",
                ],
            },
            {
                label: "Reach Truck",
                children: [
                    "Reach Truck Standar",
                    "Double Deep Reach",
                    "Narrow Aisle Reach",
                ],
            },
            {
                label: "Hand Pallet & Order Picker",
                children: [
                    "Hand Pallet Manual",
                    "Hand Pallet Elektrik",
                    "Low Level Order Picker",
                    "High Level Order Picker",
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
                    "Penerimaan Barang",
                    "Order Picking",
                    "Pengemasan & Pengiriman",
                    "Optimasi Storage",
                    "Supply Produksi",
                    "Barang Keluar",
                ],
            },
            {
                label: "Manufaktur",
                children: [
                    "Lini Produksi",
                    "Material Supply",
                    "Pengangkutan Internal",
                    "Waste Management",
                ],
            },
            {
                label: "Cold Storage",
                children: [
                    "Forklift Suhu Rendah",
                    "Freezer Warehouse",
                    "Pharmaceutical Storage",
                ],
            },
            {
                label: "Retail & Distribusi",
                children: [
                    "Cross Docking",
                    "Sortasi & Distribusi",
                    "Last-Mile Support",
                ],
            },
            {
                label: "Konstruksi & Berat",
                children: [
                    "Forklift Outdoor",
                    "Rough Terrain",
                    "Heavy Load Solution",
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
                    "Servis Berkala",
                    "Servis Darurat",
                    "Perawatan Preventif",
                    "Overhaul",
                ],
            },
            {
                label: "Suku Cadang",
                children: [
                    "Suku Cadang Original",
                    "Fast Moving Parts",
                    "Pemesanan Online",
                ],
            },
            {
                label: "Pelatihan Operator",
                children: [
                    "Sertifikasi Operator",
                    "Safety Training",
                    "In-House Training",
                ],
            },
            {
                label: "Konsultasi Teknis",
                children: [
                    "Analisa Kebutuhan",
                    "Fleet Management",
                    "Konsultasi On-Site",
                ],
            },
        ],
    },
    {
        label: "Berita",
        subItems: null,
    },
    {
        label: "Perusahaan",
        subItems: [
            {
                label: "Tentang Kami",
                children: [
                    "Sejarah Perusahaan",
                    "Visi & Misi",
                    "Sertifikasi & Penghargaan",
                ],
            },
            {
                label: "Mitra & Merek",
                children: null,
            },
            {
                label: "Karir",
                children: [
                    "Lowongan Kerja",
                    "Budaya Kerja",
                    "Benefit Karyawan",
                ],
            },
        ],
    },
    {
        label: "Kontak",
        subItems: null,
    },
];

// ── Computed ────────────────────────────────────────────────────
const activeMegaData = computed(
    () => navItems.find((i) => i.label === activeMenu.value) ?? null,
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
