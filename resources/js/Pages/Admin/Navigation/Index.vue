<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const props = defineProps({ items: Array });

// ── Selection state ──────────────────────────────────────────────
const selectedMainId = ref(null);
const selectedSubId = ref(null);

const selectedMain = computed(
    () => props.items.find((i) => i.id === selectedMainId.value) ?? null,
);
const selectedSub = computed(
    () =>
        selectedMain.value?.children?.find(
            (s) => s.id === selectedSubId.value,
        ) ?? null,
);

function selectMain(item) {
    selectedMainId.value = item.id;
    selectedSubId.value = null;
}
function selectSub(item) {
    selectedSubId.value = item.id;
}

// ── Edit modal ───────────────────────────────────────────────────
const editingItem = ref(null);
const editForm = useForm({ label: "", href: "" });

function startEdit(item) {
    editingItem.value = item;
    editForm.label = item.label;
    editForm.href = item.href ?? "";
}
function saveEdit() {
    editForm.put(route("admin.navigation.update", editingItem.value.id), {
        preserveScroll: true,
        onSuccess: () => (editingItem.value = null),
    });
}

// ── Add inline form ──────────────────────────────────────────────
const addingColumn = ref(null); // 'main' | 'sub' | 'child'
const addForm = useForm({ parent_id: null, label: "", href: "" });

function startAdd(column, parentId) {
    addingColumn.value = column;
    addForm.parent_id = parentId;
    addForm.label = "";
    addForm.href = "";
}
function cancelAdd() {
    addingColumn.value = null;
    addForm.reset();
}
function saveAdd() {
    addForm.post(route("admin.navigation.store"), {
        preserveScroll: true,
        onSuccess: () => cancelAdd(),
    });
}

// ── Delete ───────────────────────────────────────────────────────
const deletingItem = ref(null);

function confirmDelete(item) {
    deletingItem.value = item;
}
function doDelete() {
    const id = deletingItem.value.id;
    router.delete(route("admin.navigation.destroy", id), {
        preserveScroll: true,
        onSuccess: () => {
            deletingItem.value = null;
            if (id === selectedMainId.value) {
                selectedMainId.value = null;
                selectedSubId.value = null;
            }
            if (id === selectedSubId.value) selectedSubId.value = null;
        },
    });
}

// ── Reorder ──────────────────────────────────────────────────────
function move(item, direction) {
    router.post(
        route("admin.navigation.move", item.id),
        { direction },
        { preserveScroll: true },
    );
}
</script>

<template>
    <Head title="Editor Navigasi" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-2">
                <span class="text-xs text-slate-400">Sistem</span>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-xs font-semibold text-slate-700">Editor Navigasi</span>
            </div>
        </template>

        <!-- Page header -->
        <div class="mb-5">
            <h1 class="text-lg font-black text-slate-900">Editor Navigasi</h1>
            <p class="text-xs text-slate-400 mt-0.5">
                Kelola struktur menu website. Klik item untuk memilih, lalu kelola sub-menu &amp; child-nya.
            </p>
        </div>

        <!-- 3-column grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            <!-- ── Column 1: Main Nav ── -->
            <div class="bg-white border border-gray-100 rounded-lg overflow-hidden flex flex-col">
                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/60 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-700 uppercase tracking-wide">Menu Utama</p>
                        <p class="text-[10px] text-slate-400 mt-0.5">Level 1 — item di navbar atas</p>
                    </div>
                    <span class="text-[10px] font-bold text-slate-400 bg-gray-100 px-2 py-0.5 rounded-full">
                        {{ items.length }}
                    </span>
                </div>

                <div class="flex-1">
                    <div
                        v-for="item in items"
                        :key="item.id"
                        @click="selectMain(item)"
                        :class="[
                            'flex items-center gap-2 px-4 py-2.5 border-b border-gray-50 cursor-pointer transition-colors group',
                            selectedMainId === item.id
                                ? 'bg-orange-50 border-l-2 border-l-orange-600'
                                : 'hover:bg-gray-50/70',
                        ]"
                    >
                        <!-- Move buttons -->
                        <div class="flex flex-col gap-0.5 shrink-0 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button
                                type="button"
                                @click.stop="move(item, 'up')"
                                class="w-4 h-4 flex items-center justify-center text-slate-300 hover:text-slate-600 transition-colors"
                            >
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" />
                                </svg>
                            </button>
                            <button
                                type="button"
                                @click.stop="move(item, 'down')"
                                class="w-4 h-4 flex items-center justify-center text-slate-300 hover:text-slate-600 transition-colors"
                            >
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>

                        <!-- Label + href -->
                        <div class="flex-1 min-w-0">
                            <p :class="['text-sm font-semibold leading-snug truncate', selectedMainId === item.id ? 'text-orange-700' : 'text-slate-800']">
                                {{ item.label }}
                            </p>
                            <p v-if="item.href" class="text-[10px] text-slate-400 font-mono truncate mt-0.5">
                                {{ item.href }}
                            </p>
                            <p v-else class="text-[10px] text-slate-300 mt-0.5">
                                {{ item.children?.length ?? 0 }} sub-menu
                            </p>
                        </div>

                        <!-- Edit / Delete -->
                        <div class="flex items-center gap-1 shrink-0 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button
                                type="button"
                                @click.stop="startEdit(item)"
                                class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-orange-600 transition-colors"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button
                                type="button"
                                @click.stop="confirmDelete(item)"
                                class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-red-500 transition-colors"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Add inline form -->
                    <div v-if="addingColumn === 'main'" class="px-4 py-3 border-t border-gray-100 bg-orange-50/40 space-y-2">
                        <input
                            v-model="addForm.label"
                            type="text"
                            placeholder="Label menu..."
                            class="w-full border border-gray-200 px-3 py-2 text-xs text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded"
                            @keyup.enter="saveAdd"
                            @keyup.escape="cancelAdd"
                        />
                        <input
                            v-model="addForm.href"
                            type="text"
                            placeholder="URL (opsional, misal: /kontak)"
                            class="w-full border border-gray-200 px-3 py-2 text-xs text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded"
                            @keyup.enter="saveAdd"
                            @keyup.escape="cancelAdd"
                        />
                        <div class="flex gap-2">
                            <button @click="saveAdd" :disabled="!addForm.label" class="flex-1 bg-orange-600 disabled:opacity-50 hover:bg-orange-700 text-white text-xs font-bold py-1.5 rounded transition-colors">Simpan</button>
                            <button @click="cancelAdd" class="flex-1 border border-gray-200 text-xs text-slate-500 py-1.5 rounded hover:bg-gray-50 transition-colors">Batal</button>
                        </div>
                    </div>
                </div>

                <div v-if="addingColumn !== 'main'" class="px-4 py-3 border-t border-gray-100">
                    <button
                        @click="startAdd('main', null)"
                        class="flex items-center gap-1.5 text-xs font-semibold text-orange-600 hover:text-orange-700 transition-colors"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Menu Utama
                    </button>
                </div>
            </div>

            <!-- ── Column 2: Sub-Menu ── -->
            <div class="bg-white border border-gray-100 rounded-lg overflow-hidden flex flex-col">
                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/60 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-700 uppercase tracking-wide">Sub-Menu</p>
                        <p class="text-[10px] text-slate-400 mt-0.5">
                            <template v-if="selectedMain">
                                di bawah "<span class="font-semibold text-orange-600">{{ selectedMain.label }}</span>"
                            </template>
                            <template v-else>Level 2 — pilih menu utama dulu</template>
                        </p>
                    </div>
                    <span v-if="selectedMain" class="text-[10px] font-bold text-slate-400 bg-gray-100 px-2 py-0.5 rounded-full">
                        {{ selectedMain.children?.length ?? 0 }}
                    </span>
                </div>

                <div class="flex-1">
                    <template v-if="selectedMain">
                        <div
                            v-if="!selectedMain.children?.length && addingColumn !== 'sub'"
                            class="px-4 py-8 text-center"
                        >
                            <p class="text-xs text-slate-400">Belum ada sub-menu</p>
                        </div>

                        <div
                            v-for="sub in selectedMain.children ?? []"
                            :key="sub.id"
                            @click="selectSub(sub)"
                            :class="[
                                'flex items-center gap-2 px-4 py-2.5 border-b border-gray-50 cursor-pointer transition-colors group',
                                selectedSubId === sub.id
                                    ? 'bg-orange-50 border-l-2 border-l-orange-600'
                                    : 'hover:bg-gray-50/70',
                            ]"
                        >
                            <div class="flex flex-col gap-0.5 shrink-0 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button type="button" @click.stop="move(sub, 'up')" class="w-4 h-4 flex items-center justify-center text-slate-300 hover:text-slate-600">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" /></svg>
                                </button>
                                <button type="button" @click.stop="move(sub, 'down')" class="w-4 h-4 flex items-center justify-center text-slate-300 hover:text-slate-600">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                                </button>
                            </div>

                            <div class="flex-1 min-w-0">
                                <p :class="['text-sm font-semibold leading-snug truncate', selectedSubId === sub.id ? 'text-orange-700' : 'text-slate-800']">
                                    {{ sub.label }}
                                </p>
                                <p class="text-[10px] text-slate-300 mt-0.5">
                                    {{ sub.children?.length ?? 0 }} item
                                </p>
                            </div>

                            <div class="flex items-center gap-1 shrink-0 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button type="button" @click.stop="startEdit(sub)" class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-orange-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </button>
                                <button type="button" @click.stop="confirmDelete(sub)" class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-red-500">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Add inline -->
                        <div v-if="addingColumn === 'sub'" class="px-4 py-3 border-t border-gray-100 bg-orange-50/40 space-y-2">
                            <input v-model="addForm.label" type="text" placeholder="Label sub-menu..." class="w-full border border-gray-200 px-3 py-2 text-xs text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded" @keyup.enter="saveAdd" @keyup.escape="cancelAdd" />
                            <div class="flex gap-2">
                                <button @click="saveAdd" :disabled="!addForm.label" class="flex-1 bg-orange-600 disabled:opacity-50 hover:bg-orange-700 text-white text-xs font-bold py-1.5 rounded transition-colors">Simpan</button>
                                <button @click="cancelAdd" class="flex-1 border border-gray-200 text-xs text-slate-500 py-1.5 rounded hover:bg-gray-50 transition-colors">Batal</button>
                            </div>
                        </div>
                    </template>

                    <div v-else class="px-4 py-8 text-center">
                        <p class="text-xs text-slate-300">← Pilih menu utama terlebih dahulu</p>
                    </div>
                </div>

                <div v-if="selectedMain && addingColumn !== 'sub'" class="px-4 py-3 border-t border-gray-100">
                    <button
                        @click="startAdd('sub', selectedMainId)"
                        class="flex items-center gap-1.5 text-xs font-semibold text-orange-600 hover:text-orange-700 transition-colors"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Sub-Menu
                    </button>
                </div>
            </div>

            <!-- ── Column 3: Child Items ── -->
            <div class="bg-white border border-gray-100 rounded-lg overflow-hidden flex flex-col">
                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/60 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-700 uppercase tracking-wide">Item Menu</p>
                        <p class="text-[10px] text-slate-400 mt-0.5">
                            <template v-if="selectedSub">
                                di bawah "<span class="font-semibold text-orange-600">{{ selectedSub.label }}</span>"
                            </template>
                            <template v-else>Level 3 — pilih sub-menu dulu</template>
                        </p>
                    </div>
                    <span v-if="selectedSub" class="text-[10px] font-bold text-slate-400 bg-gray-100 px-2 py-0.5 rounded-full">
                        {{ selectedSub.children?.length ?? 0 }}
                    </span>
                </div>

                <div class="flex-1">
                    <template v-if="selectedSub">
                        <div
                            v-if="!selectedSub.children?.length && addingColumn !== 'child'"
                            class="px-4 py-8 text-center"
                        >
                            <p class="text-xs text-slate-400">Belum ada item</p>
                        </div>

                        <div
                            v-for="child in selectedSub.children ?? []"
                            :key="child.id"
                            class="flex items-center gap-2 px-4 py-2.5 border-b border-gray-50 group hover:bg-gray-50/70 transition-colors"
                        >
                            <div class="flex flex-col gap-0.5 shrink-0 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button type="button" @click="move(child, 'up')" class="w-4 h-4 flex items-center justify-center text-slate-300 hover:text-slate-600">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" /></svg>
                                </button>
                                <button type="button" @click="move(child, 'down')" class="w-4 h-4 flex items-center justify-center text-slate-300 hover:text-slate-600">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                                </button>
                            </div>

                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-800 leading-snug truncate">{{ child.label }}</p>
                                <p v-if="child.href" class="text-[10px] text-slate-400 font-mono truncate mt-0.5">{{ child.href }}</p>
                                <p v-else class="text-[10px] text-slate-300 mt-0.5">belum ada URL</p>
                            </div>

                            <div class="flex items-center gap-1 shrink-0 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button type="button" @click="startEdit(child)" class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-orange-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </button>
                                <button type="button" @click="confirmDelete(child)" class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-red-500">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Add inline -->
                        <div v-if="addingColumn === 'child'" class="px-4 py-3 border-t border-gray-100 bg-orange-50/40 space-y-2">
                            <input v-model="addForm.label" type="text" placeholder="Label item..." class="w-full border border-gray-200 px-3 py-2 text-xs text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded" @keyup.enter="saveAdd" @keyup.escape="cancelAdd" />
                            <input v-model="addForm.href" type="text" placeholder="URL (opsional, misal: /produk/forklift)" class="w-full border border-gray-200 px-3 py-2 text-xs text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded" @keyup.enter="saveAdd" @keyup.escape="cancelAdd" />
                            <div class="flex gap-2">
                                <button @click="saveAdd" :disabled="!addForm.label" class="flex-1 bg-orange-600 disabled:opacity-50 hover:bg-orange-700 text-white text-xs font-bold py-1.5 rounded transition-colors">Simpan</button>
                                <button @click="cancelAdd" class="flex-1 border border-gray-200 text-xs text-slate-500 py-1.5 rounded hover:bg-gray-50 transition-colors">Batal</button>
                            </div>
                        </div>
                    </template>

                    <div v-else class="px-4 py-8 text-center">
                        <p class="text-xs text-slate-300">← Pilih sub-menu terlebih dahulu</p>
                    </div>
                </div>

                <div v-if="selectedSub && addingColumn !== 'child'" class="px-4 py-3 border-t border-gray-100">
                    <button
                        @click="startAdd('child', selectedSubId)"
                        class="flex items-center gap-1.5 text-xs font-semibold text-orange-600 hover:text-orange-700 transition-colors"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Item
                    </button>
                </div>
            </div>
        </div>

        <!-- ── Edit Modal ── -->
        <div v-if="editingItem" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 px-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm p-6">
                <h3 class="text-sm font-bold text-slate-900 mb-4">Edit Item</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5">Label <span class="text-red-500">*</span></label>
                        <input
                            v-model="editForm.label"
                            type="text"
                            class="w-full border border-gray-200 px-3 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors"
                            @keyup.enter="saveEdit"
                        />
                        <p v-if="editForm.errors.label" class="mt-1 text-xs text-red-500">{{ editForm.errors.label }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5">
                            URL
                            <span class="font-normal text-slate-400 ml-1">— kosongkan jika item ini punya sub-menu</span>
                        </label>
                        <input
                            v-model="editForm.href"
                            type="text"
                            placeholder="/halaman/slug"
                            class="w-full border border-gray-200 px-3 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors"
                            @keyup.enter="saveEdit"
                        />
                    </div>
                </div>
                <div class="flex gap-2 mt-5">
                    <button @click="editingItem = null" class="flex-1 border border-gray-200 text-xs font-semibold text-slate-600 py-2.5 rounded hover:bg-gray-50 transition-colors">Batal</button>
                    <button
                        @click="saveEdit"
                        :disabled="editForm.processing || !editForm.label"
                        class="flex-1 bg-orange-600 hover:bg-orange-700 disabled:opacity-50 text-white text-xs font-bold py-2.5 rounded transition-colors"
                    >
                        {{ editForm.processing ? "Menyimpan..." : "Simpan" }}
                    </button>
                </div>
            </div>
        </div>

        <!-- ── Delete Modal ── -->
        <div v-if="deletingItem" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 px-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-sm p-6">
                <div class="w-10 h-10 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-slate-900 text-center mb-1">Hapus Item?</h3>
                <p class="text-xs text-slate-500 text-center mb-1">
                    "<span class="font-semibold">{{ deletingItem.label }}</span>" akan dihapus permanen.
                </p>
                <p v-if="deletingItem.children?.length" class="text-xs text-orange-600 text-center font-semibold mb-4">
                    Semua {{ deletingItem.children.length }} sub-item di dalamnya juga akan dihapus.
                </p>
                <p v-else class="mb-4"></p>
                <div class="flex gap-2">
                    <button @click="deletingItem = null" class="flex-1 border border-gray-200 text-xs font-semibold text-slate-600 py-2.5 rounded hover:bg-gray-50 transition-colors">Batal</button>
                    <button @click="doDelete" class="flex-1 bg-red-500 hover:bg-red-600 text-white text-xs font-bold py-2.5 rounded transition-colors">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
