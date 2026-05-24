<template>
    <div class="w-full">
        <!-- Success State -->
        <div
            v-if="submitted"
            class="flex flex-col items-center justify-center py-12 text-center"
        >
            <div
                class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mb-4"
            >
                <svg
                    class="w-7 h-7 text-green-600"
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
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">
                Pesan Terkirim!
            </h3>
            <p class="text-sm text-slate-500 mb-6 max-w-xs">
                Tim kami akan segera menghubungi Anda. Atau langsung chat
                WhatsApp untuk respons lebih cepat.
            </p>
            <div class="flex flex-wrap gap-3 justify-center">
                <a
                    :href="whatsappUrl"
                    target="_blank"
                    class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-5 py-2.5 transition-colors duration-200"
                >
                    <svg
                        class="w-4 h-4"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"
                        />
                    </svg>
                    Lanjut di WhatsApp
                </a>
                <button
                    @click="resetForm"
                    class="text-sm font-semibold text-slate-500 hover:text-orange-600 transition-colors duration-200 px-3"
                >
                    Kirim Lagi
                </button>
            </div>
        </div>

        <!-- Form -->
        <form v-else @submit.prevent="handleSubmit" novalidate>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Nama Lengkap -->
                <div class="flex flex-col gap-1.5 col-span-full">
                    <label
                        class="text-xs font-semibold text-slate-700 uppercase tracking-wide"
                    >
                        Nama Lengkap <span class="text-orange-600">*</span>
                    </label>
                    <input
                        v-model="form.name"
                        type="text"
                        placeholder="Budi Santoso"
                        :class="inputClass('name')"
                        @blur="touch('name')"
                    />
                    <span v-if="errors.name" class="text-xs text-red-500">{{
                        errors.name
                    }}</span>
                </div>

                <!-- Nama Perusahaan -->
                <div class="flex flex-col gap-1.5 col-span-full">
                    <label
                        class="text-xs font-semibold text-slate-700 uppercase tracking-wide"
                    >
                        Nama Perusahaan <span class="text-orange-600">*</span>
                    </label>
                    <input
                        v-model="form.company"
                        type="text"
                        placeholder="PT. Industri Maju"
                        :class="inputClass('company')"
                        @blur="touch('company')"
                    />
                    <span v-if="errors.company" class="text-xs text-red-500">{{
                        errors.company
                    }}</span>
                </div>

                <!-- No. WhatsApp -->
                <div class="flex flex-col gap-1.5">
                    <label
                        class="text-xs font-semibold text-slate-700 uppercase tracking-wide"
                    >
                        No. WhatsApp / Telepon
                        <span class="text-orange-600">*</span>
                    </label>
                    <input
                        v-model="form.phone"
                        type="tel"
                        placeholder="0812 3456 7890"
                        :class="inputClass('phone')"
                        @blur="touch('phone')"
                    />
                    <span v-if="errors.phone" class="text-xs text-red-500">{{
                        errors.phone
                    }}</span>
                </div>

                <!-- Email -->
                <div class="flex flex-col gap-1.5">
                    <label
                        class="text-xs font-semibold text-slate-700 uppercase tracking-wide"
                    >
                        Email
                    </label>
                    <input
                        v-model="form.email"
                        type="email"
                        placeholder="budi@perusahaan.com"
                        :class="inputClass('email')"
                        @blur="touch('email')"
                    />
                    <span v-if="errors.email" class="text-xs text-red-500">{{
                        errors.email
                    }}</span>
                </div>

                <!-- Jenis Kebutuhan -->
                <div class="flex flex-col gap-1.5 col-span-full">
                    <label
                        class="text-xs font-semibold text-slate-700 uppercase tracking-wide"
                    >
                        Jenis Kebutuhan <span class="text-orange-600">*</span>
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        <button
                            v-for="opt in needOptions"
                            :key="opt.value"
                            type="button"
                            @click="form.need = opt.value"
                            :class="[
                                'flex items-center gap-2 px-3 py-2.5 text-sm border transition-all duration-150 text-left truncate',
                                form.need === opt.value
                                    ? 'border-orange-600 bg-orange-50 text-orange-700 font-semibold'
                                    : 'border-gray-200 text-slate-600 hover:border-orange-300 hover:bg-orange-50/50',
                            ]"
                        >
                            <span
                                class="text-base leading-none flex-shrink-0"
                                >{{ opt.icon }}</span
                            >
                            <span class="truncate">{{ opt.label }}</span>
                        </button>
                    </div>
                    <span v-if="errors.need" class="text-xs text-red-500">{{
                        errors.need
                    }}</span>
                </div>

                <!-- Detail Kebutuhan -->
                <div class="flex flex-col gap-1.5 col-span-full">
                    <label
                        class="text-xs font-semibold text-slate-700 uppercase tracking-wide"
                    >
                        Detail Kebutuhan
                        <span
                            class="text-gray-400 font-normal normal-case tracking-normal ml-1"
                            >(opsional)</span
                        >
                    </label>
                    <textarea
                        v-model="form.message"
                        rows="4"
                        placeholder="Contoh: Kami membutuhkan 3 unit forklift kapasitas 3 ton untuk gudang 2.000 m², beroperasi 2 shift per hari..."
                        class="w-full px-4 py-3 text-sm text-slate-800 bg-white border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-100 outline-none transition-all duration-200 resize-none placeholder:text-gray-300"
                    ></textarea>
                </div>
            </div>

            <!-- Submit -->
            <div
                class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 mt-6"
            >
                <button
                    type="submit"
                    :disabled="loading"
                    class="inline-flex items-center justify-center gap-2 bg-orange-600 hover:bg-orange-700 disabled:bg-orange-300 text-white text-sm font-bold px-7 py-3.5 transition-colors duration-200"
                >
                    <svg
                        v-if="loading"
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
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                        />
                    </svg>
                    <svg
                        v-else
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                        />
                    </svg>
                    {{ loading ? "Mengirim..." : "Kirim Permintaan" }}
                </button>

                <!-- <a
                    :href="whatsappUrl"
                    target="_blank"
                    class="inline-flex items-center justify-center gap-2 border border-green-600 text-green-700 hover:bg-green-600 hover:text-white text-sm font-semibold px-5 py-3.5 transition-all duration-200"
                >
                    <svg
                        class="w-4 h-4 flex-shrink-0"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"
                        />
                    </svg>
                    Chat WhatsApp
                </a>

                <p
                    class="text-xs text-gray-400 sm:ml-auto text-center sm:text-left"
                >
                    Respons dalam
                    <span class="font-semibold text-slate-600">1×24 jam</span>
                    hari kerja
                </p> -->
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, computed, reactive } from "vue";

const props = defineProps({
    whatsappNumber: {
        type: String,
        default: "6221000000",
    },
});

const submitted = ref(false);
const loading = ref(false);
const touched = reactive({});

const form = reactive({
    name: "",
    company: "",
    phone: "",
    email: "",
    need: "",
    message: "",
});

const needOptions = [
    { value: "beli-baru", icon: "🏭", label: "Beli Forklift Baru" },
    { value: "sewa", icon: "📋", label: "Sewa Forklift" },
    { value: "bekas", icon: "🔄", label: "Forklift Bekas" },
    { value: "servis", icon: "🔧", label: "Servis & Perawatan" },
    { value: "suku-cadang", icon: "⚙️", label: "Suku Cadang" },
    { value: "konsultasi", icon: "💬", label: "Konsultasi Teknis" },
];

// ── Validation ──────────────────────────────────────────────────
const rules = {
    name: (v) => (v.trim().length >= 3 ? null : "Nama minimal 3 karakter"),
    company: (v) =>
        v.trim().length >= 2 ? null : "Nama perusahaan wajib diisi",
    phone: (v) =>
        /^[0-9+\s-]{8,15}$/.test(v.trim()) ? null : "Nomor telepon tidak valid",
    email: (v) =>
        !v || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)
            ? null
            : "Format email tidak valid",
    need: (v) => (v ? null : "Pilih jenis kebutuhan"),
};

const errors = computed(() => {
    const result = {};
    for (const field in rules) {
        if (touched[field]) {
            const err = rules[field](form[field]);
            if (err) result[field] = err;
        }
    }
    return result;
});

const isValid = computed(
    () =>
        !rules.name(form.name) &&
        !rules.company(form.company) &&
        !rules.phone(form.phone) &&
        !rules.email(form.email) &&
        !rules.need(form.need),
);

function touch(field) {
    touched[field] = true;
}

function touchAll() {
    Object.keys(rules).forEach((f) => {
        touched[f] = true;
    });
}

function inputClass(field) {
    const base =
        "w-full px-4 py-3 text-sm text-slate-800 bg-white border outline-none transition-all duration-200 placeholder:text-gray-300";
    if (touched[field] && errors.value[field])
        return `${base} border-red-400 focus:border-red-500 focus:ring-2 focus:ring-red-100`;
    if (touched[field] && !errors.value[field] && form[field])
        return `${base} border-green-400 focus:border-green-500 focus:ring-2 focus:ring-green-100`;
    return `${base} border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-100`;
}

// ── WhatsApp URL ────────────────────────────────────────────────
const whatsappUrl = computed(() => {
    const needLabel =
        needOptions.find((o) => o.value === form.need)?.label ?? form.need;
    const lines = [
        `Halo, saya *${form.name || "..."}* dari *${form.company || "..."}*.`,
        ``,
        `Saya tertarik dengan layanan: *${needLabel || "..."}*`,
    ];
    if (form.message.trim()) {
        lines.push(``, `Detail kebutuhan:`, form.message.trim());
    }
    lines.push(
        ``,
        `Dapat dihubungi di: ${form.phone || "..."}${form.email ? ` / ${form.email}` : ""}`,
    );
    const text = encodeURIComponent(lines.join("\n"));
    return `https://wa.me/${props.whatsappNumber}?text=${text}`;
});

// ── Submit ───────────────────────────────────────────────────────
async function handleSubmit() {
    touchAll();
    if (!isValid.value) return;

    loading.value = true;
    await new Promise((r) => setTimeout(r, 800));
    loading.value = false;
    submitted.value = true;
}

function resetForm() {
    Object.assign(form, {
        name: "",
        company: "",
        phone: "",
        email: "",
        need: "",
        message: "",
    });
    Object.keys(touched).forEach((k) => delete touched[k]);
    submitted.value = false;
}
</script>
