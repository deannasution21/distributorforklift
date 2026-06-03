<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
    category: { type: Object, default: null },
});

const isEdit = !!props.category;
const isSystem = props.category?.is_system ?? false;

const navStructure = computed(() => usePage().props.nav_structure ?? []);

const NAV_GROUPS = computed(() =>
    navStructure.value
        .filter((item) => item.subItems && item.subItems.length)
        .map((item) => item.label)
);

const NAV_SUB_MAP = computed(() => {
    const map = {};
    navStructure.value
        .filter((item) => item.subItems && item.subItems.length)
        .forEach((item) => {
            map[item.label] = item.subItems.map((sub) => sub.label);
        });
    return map;
});

const form = useForm({
    name:         props.category?.name         ?? "",
    slug:         props.category?.slug         ?? "",
    description:  props.category?.description  ?? "",
    is_active:    props.category?.is_active    ?? true,
    image:        null,
    clear_image:  false,
    nav_group:    props.category?.nav_group    ?? "",
    nav_sub:      props.category?.nav_sub      ?? "",
    nav_label:    props.category?.nav_label    ?? "",
    show_in_nav:  props.category?.show_in_nav  ?? false,
    show_inquiry: props.category?.show_inquiry ?? true,
});

const imagePreview = ref(
    props.category?.image ? "/storage/" + props.category.image : null
);
const imageInput = ref(null);

function onImageChange(e) {
    const file = e.target.files[0];
    if (!file) return;
    form.image = file;
    form.clear_image = false;
    imagePreview.value = URL.createObjectURL(file);
}

function clearImage() {
    form.image = null;
    form.clear_image = true;
    imagePreview.value = null;
    if (imageInput.value) imageInput.value.value = "";
}

function submit() {
    if (isEdit) {
        form
            .transform((data) => ({ ...data, _method: "PUT" }))
            .post(route("admin.product-categories.update", props.category.id), {
                forceFormData: true,
            });
    } else {
        form.post(route("admin.product-categories.store"), {
            forceFormData: true,
        });
    }
}
</script>

<template>
    <Head :title="isEdit ? 'Edit Kategori' : 'Tambah Kategori'" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-2">
                <span class="text-xs text-slate-400">Produk</span>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <Link :href="route('admin.product-categories.index')"
                    class="text-xs text-slate-400 hover:text-orange-600 transition-colors">
                    Kategori Produk
                </Link>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-xs font-semibold text-slate-700">{{ isEdit ? "Edit" : "Tambah" }}</span>
            </div>
        </template>

        <div class="max-w-2xl mx-auto">
            <div class="flex items-center justify-between mb-5">
                <h1 class="text-lg font-black text-slate-900">
                    {{ isEdit ? "Edit Kategori Produk" : "Tambah Kategori Produk" }}
                </h1>
            </div>

            <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-5">

                <!-- Informasi Kategori -->
                <div class="bg-white border border-gray-100 rounded-lg p-5 space-y-4">
                    <h2 class="text-xs font-bold text-slate-500 uppercase tracking-widest">Informasi Kategori</h2>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">
                            Nama Kategori <span v-if="!isSystem" class="text-red-500">*</span>
                        </label>
                        <input v-model="form.name" type="text" :required="!isSystem" :disabled="isSystem"
                            class="w-full border border-gray-200 rounded px-3 py-2 text-sm text-slate-800 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400"
                            :class="isSystem ? 'bg-gray-50 text-slate-400 cursor-not-allowed' : ''"
                            placeholder="e.g. Reach Truck" />
                        <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                    </div>

                    <!-- Slug: hidden for system, shown for regular -->
                    <div v-if="!isSystem">
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Slug URL</label>
                        <div class="flex items-center border border-gray-200 rounded overflow-hidden focus-within:border-orange-400 focus-within:ring-1 focus-within:ring-orange-400">
                            <span class="bg-gray-50 border-r border-gray-200 px-3 py-2 text-xs text-slate-400 shrink-0">/produk/</span>
                            <input v-model="form.slug" type="text"
                                class="flex-1 px-3 py-2 text-sm text-slate-800 focus:outline-none"
                                placeholder="reach-truck" />
                        </div>
                        <p class="text-xs text-slate-400 mt-1">Kosongkan untuk generate otomatis dari nama.</p>
                        <p v-if="form.errors.slug" class="text-xs text-red-500 mt-1">{{ form.errors.slug }}</p>
                    </div>
                    <div v-else>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">URL Halaman</label>
                        <div class="flex items-center border border-gray-100 rounded overflow-hidden bg-gray-50">
                            <span class="px-3 py-2 text-sm text-slate-400">/produk</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-1">URL tidak dapat diubah untuk kategori ini.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Deskripsi</label>
                        <textarea v-model="form.description" rows="3"
                            class="w-full border border-gray-200 rounded px-3 py-2 text-sm text-slate-800 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400 resize-none"
                            placeholder="Deskripsi singkat kategori ini..."></textarea>
                    </div>

                    <div v-if="!isSystem">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input v-model="form.is_active" type="checkbox"
                                class="w-4 h-4 rounded border-gray-300 text-orange-600 focus:ring-orange-400" />
                            <span class="text-sm text-slate-700 font-medium">Aktif</span>
                        </label>
                    </div>
                </div>

                <!-- Gambar Kategori -->
                <div class="bg-white border border-gray-100 rounded-lg p-5 space-y-3">
                    <h2 class="text-xs font-bold text-slate-500 uppercase tracking-widest">Gambar Kategori</h2>

                    <div v-if="imagePreview"
                        class="relative w-48 h-32 border border-gray-200 rounded overflow-hidden bg-gray-50">
                        <img :src="imagePreview" alt="Preview" class="w-full h-full object-cover" />
                        <button type="button" @click="clearImage"
                            class="absolute top-1 right-1 bg-red-600 hover:bg-red-700 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold leading-none">
                            ×
                        </button>
                    </div>

                    <div>
                        <input ref="imageInput" type="file" accept="image/*" @change="onImageChange"
                            class="block text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-bold file:bg-orange-50 file:text-orange-600 hover:file:bg-orange-100 cursor-pointer" />
                        <p class="text-xs text-slate-400 mt-1">Format JPG, PNG, WebP. Maks 2 MB.</p>
                        <p v-if="form.errors.image" class="text-xs text-red-500 mt-1">{{ form.errors.image }}</p>
                    </div>
                </div>

                <!-- Pengaturan Navigasi — disembunyikan untuk kategori sistem -->
                <div v-if="!isSystem" class="bg-white border border-gray-100 rounded-lg p-5 space-y-4">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Pengaturan Navigasi</p>

                    <!-- Toggle show_in_nav -->
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-600">Tampilkan di Menu Navigasi</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">
                                {{ form.show_in_nav ? "Kategori muncul di menu website" : "Kategori tidak muncul di menu" }}
                            </p>
                        </div>
                        <button type="button" @click="form.show_in_nav = !form.show_in_nav"
                            class="relative w-9 h-5 rounded-full transition-colors duration-200 shrink-0"
                            :class="form.show_in_nav ? 'bg-orange-600' : 'bg-gray-200'">
                            <span class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200"
                                :class="form.show_in_nav ? 'translate-x-4' : 'translate-x-0'"></span>
                        </button>
                    </div>

                    <template v-if="form.show_in_nav">
                        <!-- Menu Utama -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1.5">
                                Menu Utama <span class="text-red-500">*</span>
                            </label>
                            <select v-model="form.nav_group" @change="form.nav_sub = ''"
                                class="w-full border border-gray-200 px-3 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400 rounded bg-white">
                                <option value="" disabled>Pilih menu utama...</option>
                                <option v-for="g in NAV_GROUPS" :key="g" :value="g">{{ g }}</option>
                            </select>
                            <p v-if="form.errors.nav_group" class="mt-1 text-xs text-red-500">{{ form.errors.nav_group }}</p>
                        </div>

                        <!-- Sub-Menu -->
                        <div v-if="form.nav_group">
                            <label class="block text-xs font-semibold text-slate-500 mb-1.5">
                                Sub-Menu <span class="text-red-500">*</span>
                            </label>
                            <select v-model="form.nav_sub"
                                class="w-full border border-gray-200 px-3 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400 rounded bg-white">
                                <option value="" disabled>Pilih sub-menu...</option>
                                <option v-for="s in NAV_SUB_MAP[form.nav_group] ?? []" :key="s" :value="s">{{ s }}</option>
                            </select>
                            <p v-if="form.errors.nav_sub" class="mt-1 text-xs text-red-500">{{ form.errors.nav_sub }}</p>
                        </div>

                        <!-- Label Menu -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1.5">
                                Label Menu
                                <span class="font-normal text-slate-400 ml-1">— teks yang tampil di menu</span>
                            </label>
                            <input v-model="form.nav_label" type="text"
                                :placeholder="form.name || 'Reach Truck'"
                                class="w-full border border-gray-200 px-3 py-2 text-sm text-slate-900 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400 rounded" />
                            <p v-if="form.errors.nav_label" class="mt-1 text-xs text-red-500">{{ form.errors.nav_label }}</p>
                        </div>
                    </template>
                </div>

                <!-- Pengaturan Halaman -->
                <div class="bg-white border border-gray-100 rounded-lg p-5 space-y-4">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Pengaturan Halaman</p>

                    <!-- Sertakan Formulir Kontak -->
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-600">Sertakan Formulir Kontak</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">
                                {{ form.show_inquiry ? "Formulir kontak ditampilkan di halaman kategori ini" : "Halaman tidak menampilkan formulir kontak" }}
                            </p>
                        </div>
                        <button type="button" @click="form.show_inquiry = !form.show_inquiry"
                            class="relative w-9 h-5 rounded-full transition-colors duration-200 shrink-0"
                            :class="form.show_inquiry ? 'bg-orange-600' : 'bg-gray-200'">
                            <span class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform duration-200"
                                :class="form.show_inquiry ? 'translate-x-4' : 'translate-x-0'"></span>
                        </button>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-8 pb-2">
                    <Link :href="route('admin.product-categories.index')"
                        class="text-sm font-medium text-slate-400 hover:text-slate-600 transition-colors">
                        Batal
                    </Link>
                    <button type="submit" :disabled="form.processing"
                        class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 disabled:opacity-60 text-white text-sm font-bold px-6 py-2.5 transition-colors">
                        <svg v-if="form.processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z" />
                        </svg>
                        {{ form.processing ? "Menyimpan..." : (isEdit ? "Perbarui" : "Simpan") }}
                    </button>
                </div>

                <div v-if="Object.keys(form.errors).length"
                    class="bg-red-50 border border-red-200 rounded p-3 text-xs text-red-600">
                    Terdapat kesalahan pada form. Periksa kembali isian Anda.
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
