<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="min-h-screen flex flex-col bg-white">
        <!-- Top bar: orange accent + centered logo -->
        <header class="border-t-[5px] border-orange-600 bg-white py-4 px-6">
            <div class="flex justify-center">
                <Link href="/" class="flex items-center gap-1.5 group">
                    <div class="flex items-center gap-1">
                        <div
                            class="w-7 h-7 bg-orange-600 flex items-center justify-center"
                        >
                            <svg
                                class="w-4 h-4 text-white"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"
                                />
                            </svg>
                        </div>
                        <span
                            class="text-xl font-black text-slate-900 tracking-tight uppercase"
                        >
                            Distributor<span class="text-orange-600"
                                >Forklift</span
                            >
                        </span>
                    </div>
                </Link>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 flex items-center justify-center py-16 px-4">
            <div class="w-full max-w-sm">
                <slot />
            </div>
        </main>

        <!-- Footer -->
        <footer class="py-5 border-t border-gray-100">
            <div
                class="flex items-center justify-center gap-4 text-xs text-gray-400"
            >
                <span
                    >© {{ new Date().getFullYear() }} Distributor Forklift</span
                >
                <span class="text-gray-200">|</span>
                <a
                    href="#"
                    class="hover:text-orange-600 transition-colors duration-150"
                    >Kebijakan Privasi</a
                >
                <span class="text-gray-200">|</span>
                <a
                    href="#"
                    class="hover:text-orange-600 transition-colors duration-150"
                    >Syarat Penggunaan</a
                >
            </div>
        </footer>
    </div>
</template>
