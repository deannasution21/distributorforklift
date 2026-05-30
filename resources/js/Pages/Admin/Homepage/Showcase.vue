<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    heading: { type: String, default: "" },
    rows: { type: Object, default: () => ({}) },
});

// Build flat array of 9 cards from rows prop
const buildCards = () => {
    const cards = [];
    for (let r = 1; r <= 3; r++) {
        for (let p = 1; p <= 3; p++) {
            const slot = props.rows?.[r]?.[p] ?? {};
            cards.push({
                row:         r,
                position:    p,
                title:       slot.title       ?? "",
                description: slot.description ?? "",
                href:        slot.href        ?? "",
                image:       null,
                clear_image: false,
            });
        }
    }
    return cards;
};

const form = useForm({
    _method: "PUT",
    heading: props.heading ?? "",
    cards:   buildCards(),
});

// Image previews: index = (row-1)*3 + (position-1)
const previews = ref(
    (() => {
        const p = [];
        for (let r = 1; r <= 3; r++)
            for (let pos = 1; pos <= 3; pos++)
                p.push(props.rows?.[r]?.[pos]?.image ?? null);
        return p;
    })()
);

function cardIndex(row, position) {
    return (row - 1) * 3 + (position - 1);
}

function onImageChange(row, position, e) {
    const idx  = cardIndex(row, position);
    const file = e.target.files[0];
    if (!file) return;
    form.cards[idx].image       = file;
    form.cards[idx].clear_image = false;
    const reader = new FileReader();
    reader.onload = (ev) => (previews.value[idx] = ev.target.result);
    reader.readAsDataURL(file);
}

function clearImage(row, position) {
    const idx = cardIndex(row, position);
    form.cards[idx].image       = null;
    form.cards[idx].clear_image = true;
    previews.value[idx]         = null;
}

function submit() {
    form.post(route("admin.homepage.showcase.update"), { forceFormData: true });
}

const ROW_LABELS = ["Baris 1 — 3 Kolom", "Baris 2 — Wide + 2 Kolom", "Baris 3 — 2 Kolom"];
</script>

<template>
    <Head title="Showcase Homepage" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-2">
                <span class="text-xs text-slate-400">Homepage</span>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-xs font-semibold text-slate-700">Showcase</span>
            </div>
        </template>

        <div class="max-w-5xl mx-auto">
            <div class="flex flex-col gap-2 mb-5">
                <div>
                    <h1 class="text-lg font-black text-slate-900">Showcase Homepage</h1>
                    <p class="text-xs text-slate-400 mt-0.5">
                        Kelola 9 card showcase yang ditampilkan di halaman utama (3 baris × 3 card).
                    </p>
                </div>
            </div>

            <form @submit.prevent="submit" class="space-y-5">

                <!-- Heading -->
                <div class="bg-white border border-gray-100 rounded-lg p-5">
                    <p class="text-xs font-bold text-slate-700 uppercase tracking-wide mb-3">Judul Section</p>
                    <textarea
                        v-model="form.heading"
                        rows="2"
                        placeholder="Distributor Forklift terdepan dalam solusi material handling industri di Indonesia"
                        class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors resize-none"
                    ></textarea>
                    <p v-if="form.errors.heading" class="mt-1 text-xs text-red-500">{{ form.errors.heading }}</p>
                </div>

                <!-- Rows -->
                <div v-for="row in [1, 2, 3]" :key="row" class="bg-white border border-gray-100 rounded-lg p-5">
                    <p class="text-xs font-bold text-slate-700 uppercase tracking-wide mb-4">
                        {{ ROW_LABELS[row - 1] }}
                    </p>

                    <div class="grid grid-cols-1 gap-5"
                        :class="row === 3 ? 'md:grid-cols-2' : 'md:grid-cols-3'">
                        <div
                            v-for="pos in (row === 3 ? [1, 2] : [1, 2, 3])"
                            :key="pos"
                            class="border border-gray-100 rounded-lg p-4 space-y-3"
                            :class="row === 2 && pos === 1 ? 'md:col-span-1 border-orange-100 bg-orange-50/30' : ''"
                        >
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                Card {{ pos }}
                                <span v-if="row === 2 && pos === 1" class="text-orange-500 ml-1">(Wide)</span>
                            </p>

                            <!-- Image -->
                            <div>
                                <div v-if="previews[cardIndex(row, pos)]" class="mb-2 relative group">
                                    <img :src="previews[cardIndex(row, pos)]"
                                        class="w-full h-32 object-cover rounded" />
                                    <button type="button" @click="clearImage(row, pos)"
                                        class="absolute top-1 right-1 w-6 h-6 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity text-xs">
                                        ✕
                                    </button>
                                </div>
                                <label class="flex items-center gap-2 w-full border border-dashed border-gray-200 rounded px-3 py-2 cursor-pointer hover:border-orange-400 hover:bg-orange-50/30 transition-colors">
                                    <svg class="w-4 h-4 text-gray-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    <span class="text-xs text-slate-400">
                                        {{ previews[cardIndex(row, pos)] ? "Ganti gambar" : "Upload gambar" }}
                                    </span>
                                    <input type="file" class="hidden" accept="image/*"
                                        @change="onImageChange(row, pos, $event)" />
                                </label>
                            </div>

                            <!-- Title -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-1">Judul</label>
                                <input
                                    v-model="form.cards[cardIndex(row, pos)].title"
                                    type="text"
                                    placeholder="Judul card..."
                                    class="w-full border border-gray-200 px-3 py-2 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors"
                                />
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-1">Deskripsi</label>
                                <textarea
                                    v-model="form.cards[cardIndex(row, pos)].description"
                                    rows="2"
                                    placeholder="Deskripsi singkat..."
                                    class="w-full border border-gray-200 px-3 py-2 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors resize-none"
                                ></textarea>
                            </div>

                            <!-- Link -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 mb-1">URL Tujuan</label>
                                <input
                                    v-model="form.cards[cardIndex(row, pos)].href"
                                    type="text"
                                    placeholder="/halaman/contoh"
                                    class="w-full border border-gray-200 px-3 py-2 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-8 pb-2">
                    <Link :href="route('dashboard')"
                        class="text-sm font-medium text-slate-400 hover:text-slate-600 transition-colors">
                        Batal
                    </Link>
                    <button type="submit" :disabled="form.processing"
                        class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 disabled:opacity-50 text-white text-sm font-bold px-6 py-2.5 transition-colors duration-150">
                        <svg v-if="form.processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z" />
                        </svg>
                        {{ form.processing ? "Menyimpan..." : "Simpan Showcase" }}
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
