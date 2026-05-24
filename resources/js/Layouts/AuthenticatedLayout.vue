<script setup>
import { ref, computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
const user = computed(() => page.props.auth.user);
const sidebarOpen = ref(false);

// Company Profile submenu state — auto-open when on any homepage management route
const isCompanyProfileActive = computed(() => {
    try {
        return (
            route().current("admin.sliders.index") ||
            route().current("admin.sliders.create") ||
            route().current("admin.sliders.edit") ||
            route().current("admin.homepage.tentang")
        );
    } catch {
        return false;
    }
});
const companyProfileOpen = ref(isCompanyProfileActive.value);

const navGroups = [
    {
        label: null,
        items: [
            {
                label: "Dashboard",
                routeName: "dashboard",
                href: route("dashboard"),
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>`,
            },
        ],
    },
    {
        label: "Konten",
        items: [
            {
                label: "Produk",
                routeName: "products.index",
                href: "#",
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>`,
            },
            {
                label: "Halaman",
                routeName: "pages.index",
                href: "#",
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>`,
            },
            {
                label: "Berita",
                routeName: "news.index",
                href: "#",
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>`,
            },
        ],
    },
    {
        label: "Sistem",
        items: [
            {
                label: "Pengaturan",
                routeName: "settings.index",
                href: "#",
                icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>`,
            },
        ],
    },
];

function isItemActive(routeName) {
    try {
        return route().current(routeName);
    } catch {
        return false;
    }
}
</script>

<template>
    <div class="min-h-screen bg-gray-50 border-t-[5px] border-orange-600 flex">
        <!-- Sidebar overlay (mobile) -->
        <div
            v-if="sidebarOpen"
            @click="sidebarOpen = false"
            class="fixed inset-0 z-20 bg-slate-900/40 lg:hidden"
        ></div>

        <!-- ── Sidebar ───────────────────────────────────────────── -->
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-60 bg-white border-r border-gray-100 flex flex-col transition-transform duration-200 lg:translate-x-0 lg:sticky lg:top-0 lg:h-screen lg:z-auto"
        >
            <!-- Logo -->
            <div
                class="h-16 flex items-center px-5 border-b border-gray-100 shrink-0"
            >
                <Link
                    :href="route('dashboard')"
                    class="flex items-center gap-2"
                >
                    <div
                        class="w-6 h-6 bg-orange-600 flex items-center justify-center shrink-0"
                    >
                        <svg
                            class="w-3.5 h-3.5 text-white"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"
                            />
                        </svg>
                    </div>
                    <span
                        class="text-sm font-black text-slate-900 tracking-tight uppercase leading-none"
                    >
                        Distributor<br /><span class="text-orange-600"
                            >Forklift</span
                        >
                    </span>
                </Link>
            </div>

            <!-- Nav -->
            <nav class="flex-1 px-3 py-4 space-y-4 overflow-y-auto">
                <!-- Static nav groups -->
                <div v-for="group in navGroups" :key="group.label ?? 'main'">
                    <p
                        v-if="group.label"
                        class="px-3 mb-1 text-xs font-bold text-gray-400 uppercase tracking-widest"
                    >
                        {{ group.label }}
                    </p>
                    <div class="space-y-0.5">
                        <Link
                            v-for="item in group.items"
                            :key="item.label"
                            :href="item.href"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-md font-medium transition-colors duration-150"
                            :class="
                                isItemActive(item.routeName)
                                    ? 'bg-orange-50 text-orange-600 font-semibold'
                                    : 'text-slate-500 hover:bg-gray-50 hover:text-slate-700'
                            "
                        >
                            <svg
                                class="w-4.5 h-4.5 shrink-0 w-5 h-5"
                                :class="
                                    isItemActive(item.routeName)
                                        ? 'text-orange-600'
                                        : 'text-slate-400'
                                "
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                v-html="item.icon"
                            ></svg>
                            {{ item.label }}
                            <span
                                v-if="isItemActive(item.routeName)"
                                class="ml-auto w-1.5 h-1.5 rounded-full bg-orange-600"
                            ></span>
                        </Link>
                    </div>
                </div>

                <!-- Company Profile (collapsible) -->
                <div>
                    <p
                        class="px-3 mb-1 text-[10px] font-bold text-gray-400 uppercase tracking-widest"
                    >
                        Company Profile
                    </p>
                    <div class="space-y-0.5">
                        <!-- Group header toggle -->
                        <button
                            type="button"
                            @click="companyProfileOpen = !companyProfileOpen"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-md font-medium transition-colors duration-150"
                            :class="
                                isCompanyProfileActive
                                    ? 'bg-orange-50 text-orange-600 font-semibold'
                                    : 'text-slate-500 hover:bg-gray-50 hover:text-slate-700'
                            "
                        >
                            <svg
                                class="w-5 h-5 shrink-0"
                                :class="
                                    isCompanyProfileActive
                                        ? 'text-orange-600'
                                        : 'text-slate-400'
                                "
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
                            <span class="flex-1 text-left">Homepage</span>
                            <svg
                                class="w-3.5 h-3.5 shrink-0 transition-transform duration-200"
                                :class="[
                                    companyProfileOpen ? 'rotate-180' : '',
                                    isCompanyProfileActive
                                        ? 'text-orange-500'
                                        : 'text-slate-300',
                                ]"
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

                        <!-- Submenu -->
                        <div
                            v-show="companyProfileOpen"
                            class="ml-3 pl-3 border-l border-gray-100 space-y-0.5"
                        >
                            <Link
                                :href="route('admin.sliders.index')"
                                class="flex items-center gap-2.5 px-3 py-2 rounded-md font-medium transition-colors duration-150"
                                :class="
                                    isItemActive('admin.sliders.index') ||
                                    isItemActive('admin.sliders.create') ||
                                    isItemActive('admin.sliders.edit')
                                        ? 'bg-orange-50 text-orange-600 font-semibold'
                                        : 'text-slate-500 hover:bg-gray-50 hover:text-slate-700'
                                "
                            >
                                <svg
                                    class="w-4 h-4 shrink-0"
                                    :class="
                                        isItemActive('admin.sliders.index') ||
                                        isItemActive('admin.sliders.create') ||
                                        isItemActive('admin.sliders.edit')
                                            ? 'text-orange-500'
                                            : 'text-slate-400'
                                    "
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.75"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>
                                Hero Slider
                            </Link>
                            <Link
                                :href="route('admin.homepage.tentang')"
                                class="flex items-center gap-2.5 px-3 py-2 rounded-md font-medium transition-colors duration-150"
                                :class="
                                    isItemActive('admin.homepage.tentang')
                                        ? 'bg-orange-50 text-orange-600 font-semibold'
                                        : 'text-slate-500 hover:bg-gray-50 hover:text-slate-700'
                                "
                            >
                                <svg
                                    class="w-4 h-4 shrink-0"
                                    :class="
                                        isItemActive('admin.homepage.tentang')
                                            ? 'text-orange-500'
                                            : 'text-slate-400'
                                    "
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.75"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                </svg>
                                Tentang
                            </Link>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- User + Logout -->
            <div class="shrink-0 border-t border-gray-100 p-3">
                <div class="flex items-center gap-3 px-2 py-2.5 mb-1">
                    <div
                        class="w-7 h-7 rounded-full bg-orange-100 flex items-center justify-center shrink-0"
                    >
                        <span
                            class="text-sm font-bold text-orange-600 uppercase"
                        >
                            {{ user.name?.charAt(0) ?? "A" }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p
                            class="text-xs font-semibold text-slate-800 truncate"
                        >
                            {{ user.name }}
                        </p>
                        <p class="text-[10px] text-slate-400 truncate">
                            {{ user.email }}
                        </p>
                    </div>
                </div>
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="w-full flex items-center gap-3 px-3 py-2 rounded-md font-medium text-slate-400 hover:bg-red-50 hover:text-red-500 transition-colors duration-150"
                >
                    <svg
                        class="w-4 h-4 shrink-0"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.75"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                        />
                    </svg>
                    Keluar
                </Link>
            </div>
        </aside>

        <!-- ── Main area ─────────────────────────────────────────── -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top bar -->
            <header
                class="h-16 bg-white border-b border-gray-100 flex items-center gap-4 px-6 shrink-0"
            >
                <!-- Hamburger (mobile) -->
                <button
                    @click="sidebarOpen = !sidebarOpen"
                    class="lg:hidden p-1.5 rounded-md text-slate-400 hover:bg-gray-100 transition-colors"
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
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>

                <div class="flex-1">
                    <slot name="header" />
                </div>

                <a
                    :href="route('home')"
                    target="_blank"
                    class="hidden sm:flex items-center gap-1.5 text-xs font-medium text-slate-400 hover:text-orange-600 transition-colors duration-150"
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
                            stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                        />
                    </svg>
                    Lihat Website
                </a>
            </header>

            <!-- Page content -->
            <main class="flex-1 p-6 overflow-y-auto">
                <slot />
            </main>
        </div>
    </div>
</template>
