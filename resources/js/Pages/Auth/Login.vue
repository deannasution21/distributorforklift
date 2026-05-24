<script setup>
import { ref } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
    status: {
        type: String,
    },
});

const showPassword = ref(false);

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Masuk — Admin" />

        <!-- Status message -->
        <div
            v-if="status"
            class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-sm font-medium text-green-700"
        >
            {{ status }}
        </div>

        <!-- Heading -->
        <h1 class="text-2xl font-bold text-slate-900 text-center mb-8">
            Selamat Datang Admin!
        </h1>

        <form @submit.prevent="submit" class="space-y-5">
            <!-- Email -->
            <div>
                <label
                    for="email"
                    class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5"
                >
                    Alamat Email
                </label>
                <input
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    class="w-full border border-gray-200 px-3.5 py-2.5 text-sm text-slate-900 placeholder-gray-300 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors duration-150"
                />
                <p v-if="form.errors.email" class="mt-1.5 text-xs text-red-500">
                    {{ form.errors.email }}
                </p>
            </div>

            <!-- Password -->
            <div>
                <div class="mb-1.5">
                    <label
                        for="password"
                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wide"
                    >
                        Password
                    </label>
                </div>
                <div class="relative">
                    <input
                        id="password"
                        :type="showPassword ? 'text' : 'password'"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        class="w-full border border-gray-200 px-3.5 py-2.5 pr-10 text-sm text-slate-900 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors duration-150"
                    />
                    <button
                        type="button"
                        @click="showPassword = !showPassword"
                        tabindex="-1"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-slate-600 transition-colors duration-150"
                        :aria-label="
                            showPassword
                                ? 'Sembunyikan password'
                                : 'Tampilkan password'
                        "
                    >
                        <!-- Eye open -->
                        <svg
                            v-if="!showPassword"
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                            />
                        </svg>
                        <!-- Eye off -->
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
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 4.411m0 0L21 21"
                            />
                        </svg>
                    </button>
                </div>
                <p
                    v-if="form.errors.password"
                    class="mt-1.5 text-xs text-red-500"
                >
                    {{ form.errors.password }}
                </p>
            </div>

            <!-- Submit -->
            <button
                type="submit"
                :disabled="form.processing"
                class="w-full bg-orange-600 hover:bg-orange-700 disabled:opacity-50 text-white font-bold py-3 text-sm tracking-wider uppercase transition-colors duration-200 mt-1"
            >
                {{ form.processing ? "Memproses..." : "Masuk" }}
            </button>
        </form>
    </GuestLayout>
</template>
