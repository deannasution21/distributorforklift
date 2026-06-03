<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    product:    { type: Object, default: null },
    categories: { type: Array, default: () => [] },
});

const isEdit = !!props.product;

const form = useForm({
    product_category_id: props.product?.product_category_id ?? "",
    name:                props.product?.name                ?? "",
    slug:                props.product?.slug                ?? "",
    short_description:   props.product?.short_description   ?? "",
    full_description:    props.product?.full_description     ?? "",
    specs:               props.product?.specs               ?? [],
    is_active:           props.product?.is_active           ?? true,
    image:               null,
    clear_image:         false,
});

const imagePreview = ref(props.product?.image_url ?? null);
const imageInput   = ref(null);

function onImageChange(e) {
    const file = e.target.files[0];
    if (!file) return;
    form.image       = file;
    form.clear_image = false;
    imagePreview.value = URL.createObjectURL(file);
}

function clearImage() {
    form.image       = null;
    form.clear_image = true;
    imagePreview.value = null;
    if (imageInput.value) imageInput.value.value = "";
}

// Specs management
function addSpec() {
    form.specs.push({ label: "", value: "" });
}

function removeSpec(index) {
    form.specs.splice(index, 1);
}

function submit() {
    if (isEdit) {
        form
            .transform((data) => ({ ...data, _method: "PUT" }))
            .post(route("admin.products.update", props.product.id), {
                forceFormData: true,
            });
    } else {
        form.post(route("admin.products.store"), {
            forceFormData: true,
        });
    }
}
</script>

<template>
    <Head :title="isEdit ? 'Edit Produk' : 'Tambah Produk'" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-2">
                <span class="text-xs text-slate-400">Produk</span>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <Link :href="route('admin.products.index')"
                    class="text-xs text-slate-400 hover:text-orange-600 transition-colors">
                    Daftar Produk
                </Link>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-xs font-semibold text-slate-700">{{ isEdit ? "Edit" : "Tambah" }}</span>
            </div>
        </template>

        <div class="max-w-3xl mx-auto">
            <div class="flex items-center justify-between mb-5">
                <h1 class="text-lg font-black text-slate-900">
                    {{ isEdit ? "Edit Produk" : "Tambah Produk" }}
                </h1>
            </div>

            <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-5">

                <!-- Basic Info -->
                <div class="bg-white border border-gray-100 rounded-lg p-5 space-y-4">
                    <h2 class="text-xs font-bold text-slate-500 uppercase tracking-widest">Informasi Produk</h2>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                        <select v-model="form.product_category_id" required
                            class="w-full border border-gray-200 rounded px-3 py-2 text-sm text-slate-800 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                            <option value="">-- Pilih Kategori --</option>
                            <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                                {{ cat.name }}
                            </option>
                        </select>
                        <p v-if="form.errors.product_category_id" class="text-xs text-red-500 mt-1">{{ form.errors.product_category_id }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                        <input v-model="form.name" type="text" required
                            class="w-full border border-gray-200 rounded px-3 py-2 text-sm text-slate-800 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400"
                            placeholder="e.g. Reach Truck 1.5 Ton" />
                        <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Slug URL</label>
                        <div class="flex items-center border border-gray-200 rounded overflow-hidden focus-within:border-orange-400 focus-within:ring-1 focus-within:ring-orange-400">
                            <span class="bg-gray-50 border-r border-gray-200 px-3 py-2 text-xs text-slate-400 shrink-0">/produk/{kategori}/</span>
                            <input v-model="form.slug" type="text"
                                class="flex-1 px-3 py-2 text-sm text-slate-800 focus:outline-none"
                                placeholder="reach-truck-15-ton" />
                        </div>
                        <p class="text-xs text-slate-400 mt-1">Kosongkan untuk generate otomatis dari nama.</p>
                        <p v-if="form.errors.slug" class="text-xs text-red-500 mt-1">{{ form.errors.slug }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Deskripsi Singkat</label>
                        <textarea v-model="form.short_description" rows="2"
                            class="w-full border border-gray-200 rounded px-3 py-2 text-sm text-slate-800 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400 resize-none"
                            placeholder="Deskripsi singkat untuk card produk..."></textarea>
                    </div>

                    <div class="pt-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input v-model="form.is_active" type="checkbox"
                                class="w-4 h-4 rounded border-gray-300 text-orange-600 focus:ring-orange-400" />
                            <span class="text-sm text-slate-700 font-medium">Produk Aktif (tampil di website)</span>
                        </label>
                    </div>
                </div>

                <!-- Image -->
                <div class="bg-white border border-gray-100 rounded-lg p-5 space-y-3">
                    <h2 class="text-xs font-bold text-slate-500 uppercase tracking-widest">Foto Produk</h2>

                    <div v-if="imagePreview"
                        class="relative w-64 h-40 border border-gray-200 rounded overflow-hidden bg-gray-50">
                        <img :src="imagePreview" alt="Preview" class="w-full h-full object-cover" />
                        <button type="button" @click="clearImage"
                            class="absolute top-1 right-1 bg-red-600 hover:bg-red-700 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold leading-none">
                            ×
                        </button>
                    </div>

                    <div>
                        <input ref="imageInput" type="file" accept="image/*" @change="onImageChange"
                            class="block text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-bold file:bg-orange-50 file:text-orange-600 hover:file:bg-orange-100 cursor-pointer" />
                        <p class="text-xs text-slate-400 mt-1">Format JPG, PNG, WebP. Maks 3 MB. Disarankan rasio 4:3.</p>
                        <p v-if="form.errors.image" class="text-xs text-red-500 mt-1">{{ form.errors.image }}</p>
                    </div>
                </div>

                <!-- Specs -->
                <div class="bg-white border border-gray-100 rounded-lg p-5 space-y-3">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xs font-bold text-slate-500 uppercase tracking-widest">Spesifikasi</h2>
                        <button type="button" @click="addSpec"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-orange-600 hover:text-orange-700 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Spesifikasi
                        </button>
                    </div>

                    <p class="text-xs text-slate-400">Contoh: Label = "Kapasitas Angkat", Nilai = "1.500 kg"</p>

                    <div v-if="form.specs.length" class="space-y-2">
                        <div v-for="(spec, i) in form.specs" :key="i"
                            class="flex items-center gap-2">
                            <input v-model="spec.label" type="text" placeholder="Label"
                                class="w-2/5 border border-gray-200 rounded px-3 py-2 text-sm text-slate-800 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400" />
                            <input v-model="spec.value" type="text" placeholder="Nilai"
                                class="flex-1 border border-gray-200 rounded px-3 py-2 text-sm text-slate-800 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400" />
                            <button type="button" @click="removeSpec(i)"
                                class="text-red-400 hover:text-red-600 transition-colors shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <p v-else class="text-xs text-slate-300 italic">Belum ada spesifikasi.</p>
                </div>

                <!-- Full Description -->
                <div class="bg-white border border-gray-100 rounded-lg p-5 space-y-3">
                    <h2 class="text-xs font-bold text-slate-500 uppercase tracking-widest">Deskripsi Lengkap</h2>
                    <textarea v-model="form.full_description" rows="8"
                        class="w-full border border-gray-200 rounded px-3 py-2 text-sm text-slate-800 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400 resize-y font-mono"
                        placeholder="Deskripsi lengkap produk. Mendukung HTML dasar."></textarea>
                    <p class="text-xs text-slate-400">Mendukung HTML dasar: &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;strong&gt;, &lt;h2&gt;, &lt;h3&gt;</p>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-3">
                    <button type="submit" :disabled="form.processing"
                        class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 disabled:opacity-60 text-white text-sm font-bold px-6 py-2.5 rounded transition-colors">
                        {{ form.processing ? "Menyimpan..." : (isEdit ? "Perbarui" : "Simpan") }}
                    </button>
                    <Link :href="route('admin.products.index')"
                        class="text-sm text-slate-500 hover:text-slate-700 px-4 py-2.5 transition-colors">
                        Batal
                    </Link>
                </div>

                <div v-if="Object.keys(form.errors).length"
                    class="bg-red-50 border border-red-200 rounded p-3 text-xs text-red-600">
                    Terdapat kesalahan pada form. Periksa kembali isian Anda.
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
