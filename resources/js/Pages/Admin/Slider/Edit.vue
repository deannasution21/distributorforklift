<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    slider: Object,
});

const form = useForm({
    _method: "PUT",
    label: props.slider.label ?? "",
    title: props.slider.title ?? "",
    description: props.slider.description ?? "",
    show_cta: props.slider.show_cta ?? false,
    cta_text: props.slider.cta_text ?? "",
    cta_url: props.slider.cta_url ?? "",
    image: null,
    order: props.slider.order ?? 0,
    is_active: props.slider.is_active ?? true,
});

const imagePreview = ref(null);
const existingImage = ref(
    props.slider.image ? `/storage/${props.slider.image}` : null,
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
    form.post(route("admin.sliders.update", props.slider.id), {
        forceFormData: true,
    });
}
</script>

<template>
    <Head title="Edit Slider" />

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
                <Link
                    :href="route('admin.sliders.index')"
                    class="text-xs text-slate-400 hover:text-orange-600 transition-colors"
                    >Slider</Link
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

        <div class="max-w-2xl mx-auto">
            <div class="flex flex-col gap-2 mb-5">
                <Link
                    :href="route('admin.sliders.index')"
                    class="order-first text-xs font-medium text-slate-400 hover:text-slate-600 transition-colors self-start"
                >
                    ← Kembali
                </Link>
                <div class="order-last sm:order-first">
                    <h1 class="text-lg font-black text-slate-900">
                        Edit Slider
                    </h1>
                    <p class="text-xs text-slate-400 mt-0.5">
                        Perbarui konten slide hero section.
                    </p>
                </div>
            </div>

            <form @submit.prevent="submit" class="space-y-5">
                <!-- Upload Gambar -->
                <div class="bg-white border border-gray-100 rounded-lg p-5">
                    <label
                        class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-3"
                        >Gambar Slide</label
                    >

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

                    <!-- Gambar yang ada saat ini -->
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

                    <!-- Drop zone untuk ganti gambar -->
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

                <!-- Konten Teks -->
                <div
                    class="bg-white border border-gray-100 rounded-lg p-5 space-y-4"
                >
                    <p
                        class="text-xs font-bold text-slate-700 uppercase tracking-wide"
                    >
                        Konten Teks
                    </p>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 mb-1.5"
                        >
                            Label <span class="text-red-500">*</span>
                            <span class="font-normal text-slate-400 ml-1"
                                >— teks kecil di atas judul</span
                            >
                        </label>
                        <input
                            v-model="form.label"
                            type="text"
                            placeholder="Produk Unggulan"
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
                        >
                            Judul <span class="text-red-500">*</span>
                        </label>
                        <input
                            v-model="form.title"
                            type="text"
                            placeholder="Forklift Bertenaga Tinggi untuk Industri Modern"
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
                            >Deskripsi / Subtitle</label
                        >
                        <textarea
                            v-model="form.description"
                            rows="3"
                            placeholder="Deskripsi singkat slide ini..."
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
                                placeholder="Lihat Produk"
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
                                placeholder="/produk atau https://..."
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

                <!-- Pengaturan -->
                <div class="bg-white border border-gray-100 rounded-lg p-5">
                    <p
                        class="text-xs font-bold text-slate-700 uppercase tracking-wide mb-4"
                    >
                        Pengaturan
                    </p>
                    <div>
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-500 mb-1.5"
                                >Status</label
                            >
                            <label
                                class="flex items-center gap-2 cursor-pointer mt-2.5"
                            >
                                <button
                                    type="button"
                                    @click="form.is_active = !form.is_active"
                                    class="relative w-9 h-5 rounded-full transition-colors duration-200"
                                    :class="
                                        form.is_active
                                            ? 'bg-orange-600'
                                            : 'bg-gray-200'
                                    "
                                >
                                    <span
                                        class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200"
                                        :class="
                                            form.is_active
                                                ? 'translate-x-4'
                                                : 'translate-x-0'
                                        "
                                    ></span>
                                </button>
                                <span
                                    class="text-sm font-medium text-slate-700"
                                >
                                    {{ form.is_active ? "Aktif" : "Nonaktif" }}
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-8 pb-2">
                    <Link
                        :href="route('admin.sliders.index')"
                        class="text-sm font-medium text-slate-400 hover:text-slate-600 transition-colors"
                    >
                        Batal
                    </Link>
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
                            form.processing ? "Menyimpan..." : "Perbarui Slider"
                        }}
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
