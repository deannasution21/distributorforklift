<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import RichTextEditor from "@/Components/Admin/RichTextEditor.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const NAV_GROUPS = ["Produk", "Solusi", "Layanan", "Perusahaan"];

const NAV_SUB_MAP = {
    Produk: ["Forklift Baru", "Forklift Sewa", "Forklift Bekas", "Reach Truck", "Hand Pallet & Order Picker"],
    Solusi: ["Gudang & Logistik", "Manufaktur", "Cold Storage", "Retail & Distribusi", "Konstruksi & Berat"],
    Layanan: ["Perawatan & Servis", "Suku Cadang", "Pelatihan Operator", "Konsultasi Teknis"],
    Perusahaan: ["Tentang Kami", "Mitra & Merek", "Karir"],
};

const props = defineProps({
    page: Object,
});

const form = useForm({
    _method: "PUT",
    title: props.page.title ?? "",
    slug: props.page.slug ?? "",
    label: props.page.label ?? "",
    subtitle: props.page.subtitle ?? "",
    heading: props.page.heading ?? "",
    cta_text: props.page.cta_text ?? "",
    cta_url: props.page.cta_url ?? "",
    image: null,
    content: props.page.content ?? "",
    nav_group: props.page.nav_group ?? "",
    nav_sub: props.page.nav_sub ?? "",
    nav_label: props.page.nav_label ?? "",
    show_in_nav: props.page.show_in_nav ?? false,
    show_inquiry: props.page.show_inquiry ?? false,
    is_published: props.page.is_published ?? false,
    published_at: props.page.published_at ?? "",
});

const imagePreview = ref(null);
const existingImage = ref(props.page.image ?? null);

function onImageChange(e) {
    const file = e.target.files[0];
    if (!file) return;
    form.image = file;
    const reader = new FileReader();
    reader.onload = (ev) => (imagePreview.value = ev.target.result);
    reader.readAsDataURL(file);
}

function clearNewImage() {
    form.image = null;
    imagePreview.value = null;
}

function submit() {
    form.post(route("admin.pages.update", props.page.id), {
        forceFormData: true,
    });
}
</script>

<template>
    <Head title="Edit Halaman" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-2">
                <span class="text-xs text-slate-400">Konten</span>
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
                <Link
                    :href="route('admin.pages.index')"
                    class="text-xs text-slate-400 hover:text-orange-600 transition-colors"
                    >Halaman Statis</Link
                >
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
                <span class="text-xs font-semibold text-slate-700">Edit</span>
            </div>
        </template>

        <div class="max-w-3xl mx-auto">
            <div class="flex flex-col gap-2 mb-5">
                <Link
                    :href="route('admin.pages.index')"
                    class="text-xs font-medium text-slate-400 hover:text-slate-600 transition-colors self-start"
                    >← Kembali</Link
                >
                <div>
                    <h1 class="text-lg font-black text-slate-900">
                        Edit Halaman
                    </h1>
                    <p class="text-xs text-slate-400 mt-0.5">
                        Perbarui konten halaman statis.
                    </p>
                </div>
            </div>

            <form @submit.prevent="submit" class="space-y-5">
                <!-- Gambar Hero -->
                <div class="bg-white border border-gray-100 rounded-lg p-5">
                    <label
                        class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-3"
                        >Gambar Hero</label
                    >

                    <div v-if="imagePreview" class="mb-3 relative group w-full">
                        <img
                            :src="imagePreview"
                            class="w-full h-52 object-cover rounded-md"
                        />
                        <div
                            class="absolute top-2 left-2 bg-orange-600 text-white text-[10px] font-bold px-2 py-0.5 rounded"
                        >
                            Gambar Baru
                        </div>
                        <button
                            type="button"
                            @click="clearNewImage"
                            class="absolute top-2 right-2 w-7 h-7 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
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
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>

                    <div
                        v-else-if="existingImage"
                        class="mb-3 relative group w-full"
                    >
                        <img
                            :src="existingImage"
                            class="w-full h-52 object-cover rounded-md"
                        />
                        <div
                            class="absolute top-2 left-2 bg-slate-700 text-white text-[10px] font-bold px-2 py-0.5 rounded"
                        >
                            Gambar Saat Ini
                        </div>
                    </div>

                    <label
                        class="flex items-center gap-3 w-full border border-dashed border-gray-200 rounded-md px-4 py-3 cursor-pointer hover:border-orange-400 hover:bg-orange-50/30 transition-colors"
                    >
                        <svg
                            class="w-5 h-5 text-gray-300 shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                            />
                        </svg>
                        <div>
                            <span class="text-xs font-medium text-slate-500">{{
                                existingImage ? "Ganti gambar" : "Upload gambar"
                            }}</span>
                            <span class="text-[10px] text-slate-300 ml-1"
                                >JPG, PNG, WEBP — Maks. 3MB</span
                            >
                        </div>
                        <input
                            type="file"
                            class="hidden"
                            accept="image/*"
                            @change="onImageChange"
                        />
                    </label>
                    <p
                        v-if="form.errors.image"
                        class="mt-1.5 text-xs text-red-500"
                    >
                        {{ form.errors.image }}
                    </p>
                </div>

                <!-- Info Halaman -->
                <div
                    class="bg-white border border-gray-100 rounded-lg p-5 space-y-4"
                >
                    <p
                        class="text-xs font-bold text-slate-700 uppercase tracking-wide"
                    >
                        Informasi Halaman
                    </p>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 mb-1.5"
                            >Label Hero
                            <span class="font-normal text-slate-400 ml-1"
                                >— teks kecil di atas judul</span
                            ></label
                        >
                        <input
                            v-model="form.label"
                            type="text"
                            placeholder="Perusahaan"
                            class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors"
                        />
                        <p
                            v-if="form.errors.label"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ form.errors.label }}
                        </p>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 mb-1.5"
                            >Judul <span class="text-red-500">*</span></label
                        >
                        <input
                            v-model="form.title"
                            type="text"
                            class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors"
                        />
                        <p
                            v-if="form.errors.title"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ form.errors.title }}
                        </p>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 mb-1.5"
                            >Subtitle Hero</label
                        >
                        <textarea
                            v-model="form.subtitle"
                            rows="2"
                            class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors resize-none"
                        ></textarea>
                        <p
                            v-if="form.errors.subtitle"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ form.errors.subtitle }}
                        </p>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 mb-1.5"
                            >Slug URL</label
                        >
                        <div
                            class="flex items-center border border-gray-200 rounded focus-within:border-orange-500 focus-within:ring-1 focus-within:ring-orange-500 transition-colors overflow-hidden"
                        >
                            <span
                                class="px-3 py-2.5 text-xs text-slate-400 bg-gray-50 border-r border-gray-200 whitespace-nowrap"
                                >/halaman/</span
                            >
                            <input
                                v-model="form.slug"
                                type="text"
                                class="flex-1 px-3 py-2.5 text-sm text-slate-900 focus:outline-none bg-transparent"
                            />
                        </div>
                        <p
                            v-if="form.errors.slug"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ form.errors.slug }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-500 mb-1.5"
                                >Teks Tombol CTA</label
                            >
                            <input
                                v-model="form.cta_text"
                                type="text"
                                placeholder="Hubungi Kami"
                                class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors"
                            />
                        </div>
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-500 mb-1.5"
                                >URL Tombol CTA</label
                            >
                            <input
                                v-model="form.cta_url"
                                type="text"
                                placeholder="/#inquiry"
                                class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors"
                            />
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 mb-1.5"
                            >Heading Statement
                            <span class="font-normal text-slate-400 ml-1"
                                >— teks besar bold di bawah hero</span
                            ></label
                        >
                        <textarea
                            v-model="form.heading"
                            rows="2"
                            class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors resize-none"
                        ></textarea>
                        <p
                            v-if="form.errors.heading"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ form.errors.heading }}
                        </p>
                    </div>
                </div>

                <!-- Konten -->
                <div
                    class="bg-white border border-gray-100 rounded-lg p-5 space-y-3"
                >
                    <p
                        class="text-xs font-bold text-slate-700 uppercase tracking-wide"
                    >
                        Konten Halaman
                    </p>
                    <RichTextEditor v-model="form.content" />
                    <p v-if="form.errors.content" class="text-xs text-red-500">
                        {{ form.errors.content }}
                    </p>
                </div>

                <!-- Navigasi -->
                <div
                    class="bg-white border border-gray-100 rounded-lg p-5 space-y-4"
                >
                    <p
                        class="text-xs font-bold text-slate-700 uppercase tracking-wide"
                    >
                        Pengaturan Navigasi
                    </p>

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-600">
                                Tampilkan di Menu Navigasi
                            </p>
                            <p class="text-[10px] text-slate-400 mt-0.5">
                                {{
                                    form.show_in_nav
                                        ? "Halaman muncul di menu website"
                                        : "Halaman tidak muncul di menu"
                                }}
                            </p>
                        </div>
                        <button
                            type="button"
                            @click="form.show_in_nav = !form.show_in_nav"
                            class="relative w-9 h-5 rounded-full transition-colors duration-200 shrink-0"
                            :class="
                                form.show_in_nav
                                    ? 'bg-orange-600'
                                    : 'bg-gray-200'
                            "
                        >
                            <span
                                class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200"
                                :class="
                                    form.show_in_nav
                                        ? 'translate-x-4'
                                        : 'translate-x-0'
                                "
                            ></span>
                        </button>
                    </div>

                    <template v-if="form.show_in_nav">
                        <!-- Nav Group (main nav) -->
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-500 mb-1.5"
                                >Menu Utama
                                <span class="text-red-500">*</span></label
                            >
                            <select
                                v-model="form.nav_group"
                                @change="form.nav_sub = ''"
                                class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors bg-white"
                            >
                                <option value="" disabled>
                                    Pilih menu utama...
                                </option>
                                <option
                                    v-for="g in NAV_GROUPS"
                                    :key="g"
                                    :value="g"
                                >
                                    {{ g }}
                                </option>
                            </select>
                            <p
                                v-if="form.errors.nav_group"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.nav_group }}
                            </p>
                        </div>

                        <!-- Nav Sub (sub-menu) -->
                        <div v-if="form.nav_group">
                            <label
                                class="block text-xs font-semibold text-slate-500 mb-1.5"
                                >Sub-Menu
                                <span class="text-red-500">*</span></label
                            >
                            <select
                                v-model="form.nav_sub"
                                class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors bg-white"
                            >
                                <option value="" disabled>
                                    Pilih sub-menu...
                                </option>
                                <option
                                    v-for="s in NAV_SUB_MAP[form.nav_group] ?? []"
                                    :key="s"
                                    :value="s"
                                >
                                    {{ s }}
                                </option>
                            </select>
                            <p
                                v-if="form.errors.nav_sub"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.nav_sub }}
                            </p>
                        </div>

                        <!-- Nav Label -->
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-500 mb-1.5"
                                >Label Menu
                                <span class="font-normal text-slate-400 ml-1"
                                    >— teks yang tampil di menu</span
                                ></label
                            >
                            <input
                                v-model="form.nav_label"
                                type="text"
                                :placeholder="form.title"
                                class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors"
                            />
                            <p
                                v-if="form.errors.nav_label"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.nav_label }}
                            </p>
                        </div>
                    </template>
                </div>

                <!-- Publikasi -->
                <div
                    class="bg-white border border-gray-100 rounded-lg p-5 space-y-4"
                >
                    <p
                        class="text-xs font-bold text-slate-700 uppercase tracking-wide"
                    >
                        Pengaturan Publikasi
                    </p>

                    <!-- show_inquiry toggle -->
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-600">
                                Sertakan Formulir Kontak
                            </p>
                            <p class="text-[10px] text-slate-400 mt-0.5">
                                {{
                                    form.show_inquiry
                                        ? "Formulir kontak ditampilkan di halaman ini"
                                        : "Halaman tidak menampilkan formulir kontak"
                                }}
                            </p>
                        </div>
                        <button
                            type="button"
                            @click="form.show_inquiry = !form.show_inquiry"
                            class="relative w-9 h-5 rounded-full transition-colors duration-200 shrink-0"
                            :class="
                                form.show_inquiry
                                    ? 'bg-orange-600'
                                    : 'bg-gray-200'
                            "
                        >
                            <span
                                class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200"
                                :class="
                                    form.show_inquiry
                                        ? 'translate-x-4'
                                        : 'translate-x-0'
                                "
                            ></span>
                        </button>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-600">
                                Status Publikasi
                            </p>
                            <p class="text-[10px] text-slate-400 mt-0.5">
                                {{
                                    form.is_published
                                        ? "Halaman ditampilkan di website"
                                        : "Tersimpan sebagai draft"
                                }}
                            </p>
                        </div>
                        <button
                            type="button"
                            @click="form.is_published = !form.is_published"
                            class="relative w-9 h-5 rounded-full transition-colors duration-200 shrink-0"
                            :class="
                                form.is_published
                                    ? 'bg-orange-600'
                                    : 'bg-gray-200'
                            "
                        >
                            <span
                                class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200"
                                :class="
                                    form.is_published
                                        ? 'translate-x-4'
                                        : 'translate-x-0'
                                "
                            ></span>
                        </button>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 mb-1.5"
                            >Tanggal Publikasi</label
                        >
                        <input
                            v-model="form.published_at"
                            type="date"
                            class="border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors"
                        />
                        <p
                            v-if="form.errors.published_at"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ form.errors.published_at }}
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-8 pb-2">
                    <Link
                        :href="route('admin.pages.index')"
                        class="text-sm font-medium text-slate-400 hover:text-slate-600 transition-colors"
                        >Batal</Link
                    >
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 disabled:opacity-50 text-white text-sm font-bold px-6 py-2.5 transition-colors duration-150"
                    >
                        <svg
                            v-if="form.processing"
                            class="w-4 h-4 animate-spin"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            />
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8v8z"
                            />
                        </svg>
                        {{
                            form.processing
                                ? "Menyimpan..."
                                : "Perbarui Halaman"
                        }}
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
