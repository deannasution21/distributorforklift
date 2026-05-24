<script setup>
const currentYear = new Date().getFullYear();

const productLinks = [
    { label: "Forklift Baru", href: "#" },
    { label: "Forklift Sewa", href: "#" },
    { label: "Forklift Bekas", href: "#" },
    { label: "Reach Truck", href: "#" },
    { label: "Hand Pallet Jack", href: "#" },
];

const serviceLinks = [
    { label: "Servis & Perawatan", href: "#" },
    { label: "Suku Cadang", href: "#" },
    { label: "Konsultasi Teknis", href: "#" },
    { label: "Garansi Purna Jual", href: "#" },
];

const companyLinks = [
    { label: "Tentang Kami", href: "#" },
    { label: "Mitra & Merek", href: "#" },
    { label: "Berita & Artikel", href: "#" },
    { label: "Karir", href: "#" },
];

const infoLinks = [
    { label: "Kebijakan Privasi", href: "#" },
    { label: "Syarat & Ketentuan", href: "#" },
    { label: "Hubungi Kami", href: "#" },
];
</script>

<template>
    <footer>
        <!-- ── Top strip: CTA · Social · Hours · Contact ────────── -->
        <div class="bg-white border-t border-gray-200 py-12">
            <div class="max-w-screen-xl mx-auto px-4">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10"
                >
                    <!-- Col 1: Konsultasi CTA -->
                    <div>
                        <h4 class="md:text-2xl font-bold text-slate-900 mb-5">
                            Konsultasi Gratis
                        </h4>
                        <p
                            class="md:text-xl text-slate-500 leading-relaxed mb-5"
                        >
                            Dapatkan rekomendasi solusi material handling
                            terbaik untuk bisnis Anda.
                        </p>
                        <a
                            href="#inquiry"
                            class="inline-block border md:border-2 border-orange-600 text-orange-600 md:text-xl font-semibold px-5 py-2.5 hover:bg-orange-600 hover:text-white transition-colors duration-200"
                        >
                            Hubungi Kami
                        </a>
                    </div>

                    <!-- Col 2: Social media -->
                    <div>
                        <h4 class="md:text-2xl font-bold text-slate-900 mb-5">
                            Ikuti Kami
                        </h4>
                        <div class="flex items-center gap-2.5">
                            <a
                                href="#"
                                aria-label="Facebook"
                                class="w-9 h-9 rounded-full bg-gray-800 hover:bg-orange-600 flex items-center justify-center transition-colors duration-200"
                            >
                                <svg
                                    class="w-4 h-4 text-white"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"
                                    />
                                </svg>
                            </a>
                            <a
                                href="#"
                                aria-label="YouTube"
                                class="w-9 h-9 rounded-full bg-gray-800 hover:bg-orange-600 flex items-center justify-center transition-colors duration-200"
                            >
                                <svg
                                    class="w-4 h-4 text-white"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"
                                    />
                                </svg>
                            </a>
                            <a
                                href="#"
                                aria-label="Instagram"
                                class="w-9 h-9 rounded-full bg-gray-800 hover:bg-orange-600 flex items-center justify-center transition-colors duration-200"
                            >
                                <svg
                                    class="w-4 h-4 text-white"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Col 3: Jam Operasional -->
                    <div>
                        <h4 class="md:text-2xl font-bold text-slate-900 mb-5">
                            Jam Operasional
                        </h4>
                        <div class="space-y-1.5 md:text-xl text-slate-500">
                            <div class="flex justify-between gap-4">
                                <span>Senin – Jumat</span>
                                <span class="text-slate-700 font-medium"
                                    >08.00 – 17.00</span
                                >
                            </div>
                            <div class="flex justify-between gap-4">
                                <span>Sabtu</span>
                                <span class="text-slate-700 font-medium"
                                    >08.00 – 13.00</span
                                >
                            </div>
                            <div class="flex justify-between gap-4">
                                <span>Minggu</span>
                                <span class="text-slate-400">Tutup</span>
                            </div>
                        </div>
                    </div>

                    <!-- Col 4: Contact details -->
                    <div>
                        <h4 class="md:text-2xl font-bold text-slate-900 mb-5">
                            Kontak
                        </h4>
                        <p class="md:text-xl font-bold text-slate-900">
                            PT. Distributor Forklift Indonesia
                        </p>
                        <p class="md:text-xl font-bold text-slate-900 mb-1">
                            Jl. Industri Raya No. 123
                        </p>
                        <p class="md:text-xl text-slate-500">Jakarta Timur</p>
                        <p class="md:text-xl text-slate-500">DKI Jakarta</p>
                        <p class="md:text-xl text-slate-500 mb-3">
                            Indonesia 13000
                        </p>
                        <a
                            href="tel:+6221000000"
                            class="inline-flex items-center gap-2 text-orange-600 hover:text-orange-700 md:text-xl font-medium transition-colors"
                        >
                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                />
                            </svg>
                            +62 21 000 0000
                        </a>
                        <p class="md:text-xl text-slate-400 mt-1">
                            info@distributorforklift.com
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── Nav columns ──────────────────────────────────────── -->
        <div class="bg-white border-t border-gray-100 py-12">
            <div class="max-w-screen-xl mx-auto px-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-10">
                    <!-- Produk -->
                    <div>
                        <h4 class="md:text-2xl font-bold text-slate-900 mb-4">
                            Produk
                        </h4>
                        <ul class="space-y-2.5">
                            <li v-for="link in productLinks" :key="link.label">
                                <a
                                    :href="link.href"
                                    class="md:text-xl text-slate-500 hover:text-orange-600 transition-colors duration-150"
                                >
                                    {{ link.label }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Layanan -->
                    <div>
                        <h4 class="md:text-2xl font-bold text-slate-900 mb-4">
                            Layanan
                        </h4>
                        <ul class="space-y-2.5">
                            <li v-for="link in serviceLinks" :key="link.label">
                                <a
                                    :href="link.href"
                                    class="md:text-xl text-slate-500 hover:text-orange-600 transition-colors duration-150"
                                >
                                    {{ link.label }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Perusahaan -->
                    <div>
                        <h4 class="md:text-2xl font-bold text-slate-900 mb-4">
                            Perusahaan
                        </h4>
                        <ul class="space-y-2.5">
                            <li v-for="link in companyLinks" :key="link.label">
                                <a
                                    :href="link.href"
                                    class="md:text-xl text-slate-500 hover:text-orange-600 transition-colors duration-150"
                                >
                                    {{ link.label }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Informasi -->
                    <div>
                        <h4 class="md:text-2xl font-bold text-slate-900 mb-4">
                            Informasi
                        </h4>
                        <ul class="space-y-2.5">
                            <li v-for="link in infoLinks" :key="link.label">
                                <a
                                    :href="link.href"
                                    class="md:text-xl text-slate-500 hover:text-orange-600 transition-colors duration-150"
                                >
                                    {{ link.label }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── Bottom bar ────────────────────────────────────────── -->
        <div style="background-color: #302e2c">
            <div
                class="max-w-screen-xl mx-auto px-4 py-5 flex flex-col sm:flex-row items-center justify-between gap-3"
            >
                <p class="md:text-lg text-gray-400">
                    &copy; {{ currentYear }} Distributor Forklift. Hak Cipta
                    Dilindungi.
                </p>
                <div class="flex items-center gap-5">
                    <a
                        href="#"
                        class="md:text-lg text-gray-400 hover:text-orange-500 transition-colors"
                        >Kebijakan Privasi</a
                    >
                    <a
                        href="#"
                        class="md:text-lg text-gray-400 hover:text-orange-500 transition-colors"
                        >Syarat & Ketentuan</a
                    >
                    <a
                        href="#"
                        class="md:text-lg text-gray-400 hover:text-orange-500 transition-colors"
                        >Kontak</a
                    >
                </div>
            </div>
        </div>
    </footer>
</template>
