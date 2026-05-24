<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user);

const stats = [
    {
        label: "Total Produk",
        value: "0",
        sub: "Produk aktif di katalog",
        color: "orange",
        icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>`,
    },
    {
        label: "Total Halaman",
        value: "0",
        sub: "Halaman dinamis terbit",
        color: "blue",
        icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>`,
    },
    {
        label: "Total Berita",
        value: "0",
        sub: "Artikel dipublikasikan",
        color: "green",
        icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>`,
    },
    {
        label: "Pesan Masuk",
        value: "0",
        sub: "Inquiry belum ditangani",
        color: "purple",
        icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>`,
    },
];

const colorMap = {
    orange: {
        bg: "bg-orange-50",
        icon: "bg-orange-100",
        text: "text-orange-600",
    },
    blue: { bg: "bg-blue-50", icon: "bg-blue-100", text: "text-blue-600" },
    green: { bg: "bg-green-50", icon: "bg-green-100", text: "text-green-600" },
    purple: {
        bg: "bg-purple-50",
        icon: "bg-purple-100",
        text: "text-purple-600",
    },
};

const quickActions = [
    {
        label: "Tambah Produk",
        desc: "Tambahkan produk baru ke katalog",
        route: "dashboard",
        icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>`,
    },
    {
        label: "Buat Halaman",
        desc: "Tambahkan halaman konten baru",
        route: "dashboard",
        icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>`,
    },
    {
        label: "Tulis Berita",
        desc: "Publikasikan artikel terbaru",
        route: "dashboard",
        icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>`,
    },
    {
        label: "Pengaturan Website",
        desc: "Kelola info kontak dan branding",
        route: "dashboard",
        icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>`,
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-2">
                <span class="text-xs text-slate-400">Admin</span>
                <svg
                    class="w-3 h-3 text-slate-300"
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
                <span class="text-xs font-semibold text-slate-700"
                    >Dashboard</span
                >
            </div>
        </template>

        <!-- Greeting -->
        <div class="mb-6">
            <h1 class="text-xl font-black text-slate-900">
                Selamat datang, {{ user.name }}
            </h1>
            <p class="text-sm text-slate-400 mt-0.5">
                Ini adalah ringkasan konten dan aktivitas website Anda.
            </p>
        </div>

        <!-- Stats cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div
                v-for="stat in stats"
                :key="stat.label"
                class="bg-white border border-gray-100 rounded-lg p-5"
            >
                <div class="flex items-start justify-between mb-3">
                    <div
                        class="w-9 h-9 rounded-md flex items-center justify-center"
                        :class="colorMap[stat.color].icon"
                    >
                        <svg
                            class="w-5 h-5"
                            :class="colorMap[stat.color].text"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            v-html="stat.icon"
                        ></svg>
                    </div>
                </div>
                <div class="text-2xl font-black text-slate-900 mb-0.5">
                    {{ stat.value }}
                </div>
                <div class="text-xs font-semibold text-slate-700 mb-0.5">
                    {{ stat.label }}
                </div>
                <div class="text-xs text-slate-400">{{ stat.sub }}</div>
            </div>
        </div>

        <!-- Quick actions -->
        <div class="mb-2">
            <h2
                class="text-sm font-bold text-slate-700 mb-3 uppercase tracking-wide"
            >
                Aksi Cepat
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                <Link
                    v-for="action in quickActions"
                    :key="action.label"
                    :href="route(action.route)"
                    class="group bg-white border border-gray-100 rounded-lg p-4 hover:border-orange-200 hover:shadow-sm transition-all duration-150 flex items-start gap-3"
                >
                    <div
                        class="w-8 h-8 rounded-md bg-orange-50 group-hover:bg-orange-600 flex items-center justify-center shrink-0 transition-colors duration-150"
                    >
                        <svg
                            class="w-4 h-4 text-orange-600 group-hover:text-white transition-colors duration-150"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            v-html="action.icon"
                        ></svg>
                    </div>
                    <div>
                        <p
                            class="text-sm font-semibold text-slate-800 group-hover:text-orange-600 transition-colors duration-150"
                        >
                            {{ action.label }}
                        </p>
                        <p class="text-xs text-slate-400 mt-0.5 leading-snug">
                            {{ action.desc }}
                        </p>
                    </div>
                </Link>
            </div>
        </div>

        <!-- Info banner -->
        <div
            class="mt-6 bg-orange-50 border border-orange-100 rounded-lg px-5 py-4 flex items-center gap-4"
        >
            <div
                class="w-8 h-8 bg-orange-600 rounded-md flex items-center justify-center shrink-0"
            >
                <svg
                    class="w-4 h-4 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-800">
                    CMS sedang dalam pengembangan
                </p>
                <p class="text-xs text-slate-500 mt-0.5">
                    Fitur manajemen produk, halaman, berita, dan pengaturan akan
                    segera tersedia.
                </p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
