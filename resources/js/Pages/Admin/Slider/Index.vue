<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const props = defineProps({
    sliders: Array,
});

const page = usePage();
const flash = computed(() => page.props.flash ?? {});

const deleting = ref(null);

function confirmDelete(slider) {
    deleting.value = slider;
}

function doDelete() {
    if (!deleting.value) return;
    router.delete(route("admin.sliders.destroy", deleting.value.id), {
        onFinish: () => (deleting.value = null),
    });
}
</script>

<template>
    <Head title="Manajemen Slider" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-2">
                <span class="text-xs text-slate-400">Company Profile</span>
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
                <span class="text-xs font-semibold text-slate-700">Slider</span>
            </div>
        </template>

        <!-- Flash message -->
        <div
            v-if="flash.success"
            class="mb-5 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-lg"
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
                    stroke-width="2"
                    d="M5 13l4 4L19 7"
                />
            </svg>
            {{ flash.success }}
        </div>

        <!-- Header row -->
        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-5"
        >
            <div>
                <h1 class="text-lg font-black text-slate-900">Hero Slider</h1>
                <p class="text-xs text-slate-400 mt-0.5">
                    Kelola slide pada section hero homepage.
                </p>
            </div>
            <Link
                :href="route('admin.sliders.create')"
                class="inline-flex w-fit items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white text-xs font-bold px-4 py-2.5 transition-colors duration-150"
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
                        stroke-width="2.5"
                        d="M12 4v16m8-8H4"
                    />
                </svg>
                Tambah Slider
            </Link>
        </div>

        <!-- Empty state -->
        <div
            v-if="sliders.length === 0"
            class="bg-white border border-gray-100 rounded-lg py-16 text-center"
        >
            <div
                class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-3"
            >
                <svg
                    class="w-6 h-6 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                    />
                </svg>
            </div>
            <p class="text-sm font-semibold text-slate-600">Belum ada slider</p>
            <p class="text-xs text-slate-400 mt-1">
                Tambahkan slide pertama untuk hero section homepage.
            </p>
        </div>

        <!-- Table -->
        <div
            v-else
            class="bg-white border border-gray-100 rounded-lg overflow-hidden"
        >
            <div class="overflow-x-auto">
                <table class="w-full text-sm min-w-[640px]">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/60">
                            <th
                                class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-5 py-3"
                            >
                                Gambar
                            </th>
                            <th
                                class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-5 py-3"
                            >
                                Label / Judul
                            </th>
                            <th
                                class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-5 py-3"
                            >
                                CTA
                            </th>
                            <th
                                class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-5 py-3"
                            >
                                Status
                            </th>
                            <th class="px-5 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <tr
                            v-for="slider in sliders"
                            :key="slider.id"
                            class="hover:bg-gray-50/50 transition-colors"
                        >
                            <td class="px-5 py-3.5">
                                <div
                                    class="w-16 h-10 bg-gray-100 rounded overflow-hidden"
                                >
                                    <img
                                        v-if="slider.image"
                                        :src="`/storage/${slider.image}`"
                                        :alt="slider.title"
                                        class="w-full h-full object-cover"
                                    />
                                    <div
                                        v-else
                                        class="w-full h-full flex items-center justify-center"
                                    >
                                        <svg
                                            class="w-4 h-4 text-gray-300"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3.5">
                                <p
                                    class="text-[10px] font-bold text-orange-600 uppercase tracking-widest mb-0.5"
                                >
                                    {{ slider.label }}
                                </p>
                                <p
                                    class="font-semibold text-slate-800 leading-snug"
                                >
                                    {{ slider.title }}
                                </p>
                                <p
                                    v-if="slider.description"
                                    class="text-xs text-slate-400 mt-0.5 line-clamp-1"
                                >
                                    {{ slider.description }}
                                </p>
                            </td>
                            <td class="px-5 py-3.5">
                                <span
                                    v-if="slider.show_cta"
                                    class="inline-flex items-center gap-1 text-xs font-medium text-slate-700"
                                >
                                    <svg
                                        class="w-3.5 h-3.5 text-green-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2.5"
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>
                                    {{ slider.cta_text }}
                                </span>
                                <span v-else class="text-xs text-slate-300"
                                    >—</span
                                >
                            </td>
                            <td class="px-5 py-3.5">
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wide"
                                    :class="
                                        slider.is_active
                                            ? 'bg-green-50 text-green-600'
                                            : 'bg-gray-100 text-gray-400'
                                    "
                                >
                                    <span
                                        class="w-1.5 h-1.5 rounded-full"
                                        :class="
                                            slider.is_active
                                                ? 'bg-green-500'
                                                : 'bg-gray-300'
                                        "
                                    ></span>
                                    {{
                                        slider.is_active ? "Aktif" : "Nonaktif"
                                    }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                <div
                                    class="flex items-center gap-2 justify-end"
                                >
                                    <Link
                                        :href="
                                            route(
                                                'admin.sliders.edit',
                                                slider.id,
                                            )
                                        "
                                        class="inline-flex items-center gap-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-bold px-3 py-1.5 rounded transition-colors duration-150"
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
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                            />
                                        </svg>
                                        Edit
                                    </Link>
                                    <button
                                        @click="confirmDelete(slider)"
                                        class="inline-flex items-center gap-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-3 py-1.5 rounded transition-colors duration-150"
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
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                            />
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

        <!-- Delete confirm modal -->
        <div
            v-if="deleting"
            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 px-4"
        >
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm p-6">
                <div
                    class="w-10 h-10 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4"
                >
                    <svg
                        class="w-5 h-5 text-red-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"
                        />
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-slate-900 text-center mb-1">
                    Hapus Slider?
                </h3>
                <p class="text-xs text-slate-500 text-center mb-5">
                    Slide "<span class="font-semibold">{{
                        deleting.title
                    }}</span
                    >" akan dihapus permanen beserta gambarnya.
                </p>
                <div class="flex gap-2">
                    <button
                        @click="deleting = null"
                        class="flex-1 border border-gray-200 text-xs font-semibold text-slate-600 py-2.5 rounded hover:bg-gray-50 transition-colors"
                    >
                        Batal
                    </button>
                    <button
                        @click="doDelete"
                        class="flex-1 bg-red-500 hover:bg-red-600 text-white text-xs font-bold py-2.5 rounded transition-colors"
                    >
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
