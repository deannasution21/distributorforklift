<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import RichTextEditor from "@/Components/Admin/RichTextEditor.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    about: Object,
});

const form = useForm({
    _method: "PUT",
    section_title: props.about.section_title ?? "",
    title: props.about.title ?? "",
    description: props.about.description ?? "",
    box_title: props.about.box_title ?? "",
    box_description: props.about.box_description ?? "",
    image: null,
    show_cta: props.about.show_cta ?? false,
    cta_text: props.about.cta_text ?? "",
    cta_url: props.about.cta_url ?? "",
    long_description: props.about.long_description ?? "",
});

const imagePreview = ref(null);
const existingImage = ref(
    props.about.image ? `/storage/${props.about.image}` : null,
);

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
    form.post(route("admin.homepage.tentang.update"), {
        forceFormData: true,
    });
}
</script>

<template>
    <Head title="Tentang — Homepage" />

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
                <span class="text-xs text-slate-400">Homepage</span>
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
                    >Tentang</span
                >
            </div>
        </template>

        <div class="max-w-2xl mx-auto">
            <div class="flex flex-col gap-2 mb-5">
                <div>
                    <h1 class="text-lg font-black text-slate-900">
                        Konten Tentang
                    </h1>
                    <p class="text-xs text-slate-400 mt-0.5">
                        Perbarui konten section Tentang pada homepage.
                    </p>
                </div>
            </div>

            <!-- Flash success -->
            <div
                v-if="$page.props.flash?.success"
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
                {{ $page.props.flash.success }}
            </div>

            <form @submit.prevent="submit" class="space-y-5">
                <!-- Section Header -->
                <div
                    class="bg-white border border-gray-100 rounded-lg p-5 space-y-4"
                >
                    <p
                        class="text-xs font-bold text-slate-700 uppercase tracking-wide"
                    >
                        Header Section
                    </p>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 mb-1.5"
                        >
                            Section Title <span class="text-red-500">*</span>
                            <span class="font-normal text-slate-400 ml-1"
                                >— judul kecil di atas heading</span
                            >
                        </label>
                        <input
                            v-model="form.section_title"
                            type="text"
                            placeholder="Tentang Perusahaan"
                            class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors"
                        />
                        <p
                            v-if="form.errors.section_title"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ form.errors.section_title }}
                        </p>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 mb-1.5"
                        >
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input
                            v-model="form.title"
                            type="text"
                            placeholder="Mitra terpercaya solusi material handling industri Indonesia"
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
                        >
                            Subtitle / Deskripsi
                        </label>
                        <textarea
                            v-model="form.description"
                            rows="3"
                            placeholder="Deskripsi singkat di bawah title..."
                            class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors resize-none"
                        ></textarea>
                        <p
                            v-if="form.errors.description"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ form.errors.description }}
                        </p>
                    </div>
                </div>

                <!-- Image -->
                <div class="bg-white border border-gray-100 rounded-lg p-5">
                    <label
                        class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-3"
                    >
                        Gambar
                    </label>

                    <!-- Preview gambar baru -->
                    <div v-if="imagePreview" class="mb-3 relative group w-full">
                        <img
                            :src="imagePreview"
                            class="w-full h-48 object-cover rounded-md"
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

                    <!-- Gambar saat ini -->
                    <div
                        v-else-if="existingImage"
                        class="mb-3 relative group w-full"
                    >
                        <img
                            :src="existingImage"
                            class="w-full h-48 object-cover rounded-md"
                        />
                        <div
                            class="absolute top-2 left-2 bg-slate-700 text-white text-[10px] font-bold px-2 py-0.5 rounded"
                        >
                            Gambar Saat Ini
                        </div>
                    </div>

                    <!-- Upload zone -->
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

                <!-- Box / Card overlay -->
                <div
                    class="bg-white border border-gray-100 rounded-lg p-5 space-y-4"
                >
                    <p
                        class="text-xs font-bold text-slate-700 uppercase tracking-wide"
                    >
                        Box / Card Overlay
                    </p>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 mb-1.5"
                        >
                            Box Title
                        </label>
                        <input
                            v-model="form.box_title"
                            type="text"
                            placeholder="Distributor Forklift"
                            class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors"
                        />
                        <p
                            v-if="form.errors.box_title"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ form.errors.box_title }}
                        </p>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 mb-1.5"
                        >
                            Box Subtitle / Deskripsi
                        </label>
                        <textarea
                            v-model="form.box_description"
                            rows="3"
                            placeholder="Deskripsi singkat yang tampil di dalam box overlay..."
                            class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors resize-none"
                        ></textarea>
                        <p
                            v-if="form.errors.box_description"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ form.errors.box_description }}
                        </p>
                    </div>
                </div>

                <!-- CTA -->
                <div
                    class="bg-white border border-gray-100 rounded-lg p-5 space-y-4"
                >
                    <div class="flex items-center justify-between">
                        <p
                            class="text-xs font-bold text-slate-700 uppercase tracking-wide"
                        >
                            Tombol CTA
                        </p>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <span class="text-xs text-slate-500"
                                >Tampilkan tombol</span
                            >
                            <button
                                type="button"
                                @click="form.show_cta = !form.show_cta"
                                class="relative w-9 h-5 rounded-full transition-colors duration-200"
                                :class="
                                    form.show_cta
                                        ? 'bg-orange-600'
                                        : 'bg-gray-200'
                                "
                            >
                                <span
                                    class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200"
                                    :class="
                                        form.show_cta
                                            ? 'translate-x-4'
                                            : 'translate-x-0'
                                    "
                                ></span>
                            </button>
                        </label>
                    </div>

                    <template v-if="form.show_cta">
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-500 mb-1.5"
                            >
                                Teks Tombol <span class="text-red-500">*</span>
                            </label>
                            <input
                                v-model="form.cta_text"
                                type="text"
                                placeholder="Tentang Kami"
                                class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors"
                            />
                            <p
                                v-if="form.errors.cta_text"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.cta_text }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-500 mb-1.5"
                            >
                                URL Tombol <span class="text-red-500">*</span>
                            </label>
                            <input
                                v-model="form.cta_url"
                                type="text"
                                placeholder="/tentang-kami atau https://..."
                                class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors"
                            />
                            <p
                                v-if="form.errors.cta_url"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.cta_url }}
                            </p>
                        </div>
                    </template>
                </div>

                <!-- Long Description (Rich Text) -->
                <div class="bg-white border border-gray-100 rounded-lg p-5">
                    <label
                        class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-3"
                    >
                        Deskripsi Panjang
                        <span
                            class="font-normal text-slate-400 ml-1 normal-case"
                            >— tampil di bawah gambar</span
                        >
                    </label>
                    <RichTextEditor v-model="form.long_description" />
                    <p
                        v-if="form.errors.long_description"
                        class="mt-1.5 text-xs text-red-500"
                    >
                        {{ form.errors.long_description }}
                    </p>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pb-2">
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
                                : "Simpan Perubahan"
                        }}
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
