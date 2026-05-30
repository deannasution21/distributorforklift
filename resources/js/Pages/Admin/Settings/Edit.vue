<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({ setting: Object });

const form = useForm({
    _method:   "PUT",
    phone:     props.setting.phone ?? "",
    whatsapp:  props.setting.whatsapp ?? "",
    email:     props.setting.email ?? "",
    address:   props.setting.address ?? "",
    youtube:   props.setting.youtube ?? "",
    instagram: props.setting.instagram ?? "",
    tiktok:    props.setting.tiktok ?? "",
    facebook:  props.setting.facebook ?? "",
});

function submit() {
    form.post(route("admin.settings.update"));
}
</script>

<template>
    <Head title="Pengaturan" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-2">
                <span class="text-xs text-slate-400">Sistem</span>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-xs font-semibold text-slate-700">Pengaturan</span>
            </div>
        </template>

        <div class="max-w-2xl mx-auto">
            <div class="mb-5">
                <h1 class="text-lg font-black text-slate-900">Pengaturan Situs</h1>
                <p class="text-xs text-slate-400 mt-0.5">Informasi perusahaan dan media sosial.</p>
            </div>

            <form @submit.prevent="submit" class="space-y-5">

                <!-- Informasi Kontak -->
                <div class="bg-white border border-gray-100 rounded-lg p-5 space-y-4">
                    <p class="text-xs font-bold text-slate-700 uppercase tracking-wide">Informasi Kontak</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1.5">Nomor Telepon</label>
                            <input v-model="form.phone" type="text" placeholder="+62 21 0000 0000"
                                class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors" />
                            <p v-if="form.errors.phone" class="mt-1 text-xs text-red-500">{{ form.errors.phone }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1.5">Nomor WhatsApp <span class="font-normal text-slate-400">— tanpa tanda +</span></label>
                            <input v-model="form.whatsapp" type="text" placeholder="6281200000000"
                                class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors" />
                            <p v-if="form.errors.whatsapp" class="mt-1 text-xs text-red-500">{{ form.errors.whatsapp }}</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5">Email Perusahaan</label>
                        <input v-model="form.email" type="email" placeholder="info@perusahaan.co.id"
                            class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors" />
                        <p v-if="form.errors.email" class="mt-1 text-xs text-red-500">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5">Alamat</label>
                        <textarea v-model="form.address" rows="3" placeholder="Jl. Raya Industri No. 1, Jakarta"
                            class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors resize-none"></textarea>
                        <p v-if="form.errors.address" class="mt-1 text-xs text-red-500">{{ form.errors.address }}</p>
                    </div>
                </div>

                <!-- Media Sosial -->
                <div class="bg-white border border-gray-100 rounded-lg p-5 space-y-4">
                    <p class="text-xs font-bold text-slate-700 uppercase tracking-wide">Media Sosial</p>
                    <p class="text-[11px] text-slate-400 -mt-2">Isi username atau URL lengkap profil akun.</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1.5">Instagram</label>
                            <div class="flex items-center border border-gray-200 rounded focus-within:border-orange-500 focus-within:ring-1 focus-within:ring-orange-500 transition-colors">
                                <span class="px-3 text-xs text-slate-400 border-r border-gray-200 py-2.5">instagram.com/</span>
                                <input v-model="form.instagram" type="text" placeholder="username"
                                    class="flex-1 px-3 py-2.5 text-sm text-slate-900 focus:outline-none bg-transparent" />
                            </div>
                            <p v-if="form.errors.instagram" class="mt-1 text-xs text-red-500">{{ form.errors.instagram }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1.5">TikTok</label>
                            <div class="flex items-center border border-gray-200 rounded focus-within:border-orange-500 focus-within:ring-1 focus-within:ring-orange-500 transition-colors">
                                <span class="px-3 text-xs text-slate-400 border-r border-gray-200 py-2.5">tiktok.com/@</span>
                                <input v-model="form.tiktok" type="text" placeholder="username"
                                    class="flex-1 px-3 py-2.5 text-sm text-slate-900 focus:outline-none bg-transparent" />
                            </div>
                            <p v-if="form.errors.tiktok" class="mt-1 text-xs text-red-500">{{ form.errors.tiktok }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1.5">Facebook</label>
                            <div class="flex items-center border border-gray-200 rounded focus-within:border-orange-500 focus-within:ring-1 focus-within:ring-orange-500 transition-colors">
                                <span class="px-3 text-xs text-slate-400 border-r border-gray-200 py-2.5">facebook.com/</span>
                                <input v-model="form.facebook" type="text" placeholder="username"
                                    class="flex-1 px-3 py-2.5 text-sm text-slate-900 focus:outline-none bg-transparent" />
                            </div>
                            <p v-if="form.errors.facebook" class="mt-1 text-xs text-red-500">{{ form.errors.facebook }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1.5">YouTube <span class="font-normal text-slate-400">— URL channel</span></label>
                            <input v-model="form.youtube" type="text" placeholder="https://youtube.com/@channel"
                                class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 rounded transition-colors" />
                            <p v-if="form.errors.youtube" class="mt-1 text-xs text-red-500">{{ form.errors.youtube }}</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end pb-2">
                    <button type="submit" :disabled="form.processing"
                        class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 disabled:opacity-50 text-white text-sm font-bold px-6 py-2.5 transition-colors duration-150">
                        <svg v-if="form.processing" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z" />
                        </svg>
                        {{ form.processing ? "Menyimpan..." : "Simpan Perubahan" }}
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
