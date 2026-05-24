<template>
    <PublicLayout>
        <!-- ============================================================
         HERO SECTION — Split layout: 35% text | 65% image
    ============================================================ -->
        <section
            class="relative w-full bg-white overflow-hidden hero-section border-b border-b-gray-100"
        >
            <!-- Left Arrow -->
            <button
                @click="prevSlide"
                class="absolute left-0 top-1/2 -translate-y-1/2 z-20 w-10 h-16 flex items-center justify-center text-gray-300 hover:text-orange-600 transition-colors duration-200"
                aria-label="Sebelumnya"
            >
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
            </button>

            <!-- Right Arrow -->
            <button
                @click="nextSlide"
                class="absolute right-0 top-1/2 -translate-y-1/2 z-20 w-10 h-16 flex items-center justify-center text-gray-300 hover:text-orange-600 transition-colors duration-200"
                aria-label="Berikutnya"
            >
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M9 5l7 7-7 7"
                    />
                </svg>
            </button>

            <!-- Slides -->
            <transition-group name="hero-fade">
                <div
                    v-for="(slide, index) in sliders"
                    :key="slide.id"
                    v-show="currentSlide === index"
                    class="absolute inset-0 flex justify-center"
                >
                    <div class="w-full flex flex-col md:flex-row">
                        <!-- Col Left -->
                        <div class="hero-left-col flex flex-col justify-center">
                            <div class="inline-flex items-center gap-2 mb-5">
                                <span class="w-6 h-0.5 bg-orange-600"></span>
                                <span
                                    class="text-xs font-bold text-orange-600 uppercase tracking-widest"
                                    >{{ slide.label }}</span
                                >
                            </div>
                            <h1
                                class="text-3xl lg:text-4xl xl:text-[2.6rem] font-bold text-slate-900 leading-tight mb-4"
                            >
                                {{ slide.title }}
                            </h1>
                            <p
                                class="lg:text-2xl text-slate-500 leading-relaxed mb-8"
                            >
                                {{ slide.description }}
                            </p>
                            <div v-if="slide.show_cta && slide.cta_text">
                                <a
                                    :href="slide.cta_url || '#inquiry'"
                                    class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white md:text-xl font-bold px-6 py-3 transition-colors duration-200"
                                >
                                    {{ slide.cta_text }}
                                    <svg
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2.5"
                                            d="M9 5l7 7-7 7"
                                        />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Col Right -->
                        <div
                            class="hero-right-col overflow-hidden bg-gray-100 relative"
                        >
                            <img
                                v-if="slide.image"
                                :src="`/storage/${slide.image}`"
                                :alt="slide.title"
                                class="w-full h-full object-cover"
                            />
                        </div>
                    </div>
                </div>
            </transition-group>

            <!-- Dots -->
            <div class="hero-dots z-10">
                <div class="flex items-center gap-2">
                    <button
                        v-for="(_, index) in sliders"
                        :key="index"
                        @click="
                            currentSlide = index;
                            resetAutoplay();
                        "
                        :aria-label="`Slide ${index + 1}`"
                        class="transition-all duration-300 rounded-full"
                        :class="
                            currentSlide === index
                                ? 'w-6 h-2 bg-orange-600 rounded-full'
                                : 'w-2 h-2 bg-gray-300 hover:bg-gray-400 rounded-full'
                        "
                    ></button>
                </div>
            </div>
        </section>

        <!-- ============================================================
         STATEMENT BANNER — Bold left-aligned heading
    ============================================================ -->
        <section class="bg-white pt-14 pb-20">
            <div class="max-w-screen-xl mx-auto px-4">
                <h2
                    class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 leading-tight md:leading-[60px] lg:leading-[68px] max-w-4xl"
                >
                    Distributor Forklift terdepan dalam solusi material handling
                    industri di Indonesia
                </h2>
            </div>
        </section>

        <!-- ============================================================
         PRODUCT CARDS ROW 1 — 3 bordered cards, STILL UK style
    ============================================================ -->
        <section class="bg-white pb-12">
            <div class="max-w-screen-xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        v-for="card in serviceCards.slice(0, 3)"
                        :key="card.title"
                        class="group cursor-pointer flex flex-col border border-gray-200"
                    >
                        <div class="p-6 md:p-8 flex-1 min-h-[180px]">
                            <h3
                                class="text-xl md:text-3xl font-black text-slate-900 group-hover:text-orange-600 leading-tight mb-10 transition-colors duration-200"
                            >
                                {{ card.title }}
                            </h3>
                            <p
                                class="md:text-xl text-gray-400 leading-relaxed mb-8"
                            >
                                {{ card.description }}
                            </p>
                        </div>
                        <div class="overflow-hidden h-[230px]">
                            <img
                                :src="card.image"
                                :alt="card.title"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================
         PRODUCT CARDS ROW 2 — Pattern background, white cards floating
    ============================================================ -->
        <section
            style="
                background: #f0f0f0 url(&quot;/static/bg-pattern.jpg&quot;) 50%
                    50%;
                background-size: cover;
            "
            class="py-12"
        >
            <div class="max-w-screen-xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 px-4">
                    <!-- Wide card: spans 2 cols -->
                    <div
                        class="group md:col-span-2 bg-white cursor-pointer flex flex-col"
                    >
                        <div class="p-6 md:p-8 flex-1 min-h-[180px]">
                            <h3
                                class="text-xl md:text-3xl font-black text-slate-900 group-hover:text-orange-600 mb-10 leading-tight transition-colors duration-200"
                            >
                                {{ serviceCards[3].title }}
                            </h3>
                            <p
                                class="md:text-xl text-gray-400 leading-relaxed mb-8"
                            >
                                {{ serviceCards[3].description }}
                            </p>
                        </div>
                        <div class="overflow-hidden h-[230px] md:h-[360px]">
                            <img
                                :src="serviceCards[3].image"
                                :alt="serviceCards[3].title"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            />
                        </div>
                    </div>
                    <!-- Two narrow white cards -->
                    <div
                        v-for="card in serviceCards.slice(4, 6)"
                        :key="card.title"
                        class="group bg-white cursor-pointer flex flex-col"
                    >
                        <div class="px-7 pt-7 pb-5 flex-1 min-h-[180px]">
                            <h3
                                class="text-xl md:text-3xl font-black text-slate-900 group-hover:text-orange-600 leading-tight mb-10 transition-colors duration-200"
                            >
                                {{ card.title }}
                            </h3>
                            <p
                                class="md:text-xl text-gray-400 leading-relaxed mb-8 md:mb-0"
                            >
                                {{ card.description }}
                            </p>
                        </div>
                        <div class="overflow-hidden h-[230px] md:h-[169px]">
                            <img
                                :src="card.image"
                                :alt="card.title"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================
         PRODUCT CARDS ROW 3 — 2 bordered cards, STILL UK style
    ============================================================ -->
        <section class="bg-white py-12">
            <div class="max-w-screen-xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-y-16">
                    <div
                        v-for="card in serviceCards.slice(0, 4)"
                        :key="card.title"
                        class="group cursor-pointer flex flex-col border border-gray-200"
                    >
                        <div class="p-6 md:p-8 flex-1 min-h-[180px]">
                            <h3
                                class="text-xl md:text-3xl font-black text-slate-900 group-hover:text-orange-600 leading-tight mb-10 transition-colors duration-200"
                            >
                                {{ card.title }}
                            </h3>
                            <p
                                class="md:text-xl text-gray-400 leading-relaxed mb-8"
                            >
                                {{ card.description }}
                            </p>
                        </div>
                        <div class="overflow-hidden h-[230px] md:h-[370px]">
                            <img
                                :src="card.image"
                                :alt="card.title"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================
         NEWS SECTION — Horizontal cards
    ============================================================ -->
        <section class="bg-white py-20">
            <div class="max-w-screen-xl mx-auto px-4">
                <!-- Section Header -->
                <h2
                    class="text-3xl md:text-4xl font-black text-center mb-12 text-slate-900"
                >
                    Berita & Artikel
                </h2>

                <!-- News Grid -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
                >
                    <article
                        v-for="article in news"
                        :key="article.title"
                        class="group flex flex-col"
                    >
                        <div class="overflow-hidden mb-5">
                            <img
                                :src="article.image"
                                :alt="article.title"
                                class="w-full h-[286px] object-cover group-hover:scale-105 transition-transform duration-500"
                            />
                        </div>
                        <div class="flex items-center gap-2 mb-3">
                            <span
                                class="md:text-xl font-bold text-orange-600 uppercase tracking-wider"
                                >{{ article.category }}</span
                            >
                            <span class="text-gray-300">•</span>
                            <span class="md:text-xl text-gray-400">{{
                                article.date
                            }}</span>
                        </div>
                        <h3
                            class="text-lg md:text-2xl font-bold text-slate-900 mb-2 leading-snug group-hover:text-orange-600 transition-colors duration-200"
                        >
                            {{ article.title }}
                        </h3>
                        <p
                            class="md:text-xl text-slate-500 leading-relaxed mb-4 flex-1"
                        >
                            {{ article.excerpt }}
                        </p>
                        <a
                            href="#"
                            class="inline-flex items-center gap-1.5 md:text-xl font-semibold text-orange-600 hover:text-orange-700 transition-colors duration-200"
                        >
                            Baca Selengkapnya
                            <svg
                                class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2.5"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </a>
                    </article>
                </div>

                <!-- Mobile: Lihat Semua -->
                <div class="mt-16 text-center">
                    <a
                        href="#"
                        class="inline-flex items-center gap-2 md:text-xl font-bold px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white transition-colors duration-200"
                    >
                        Lihat Semua Berita
                    </a>
                </div>
            </div>
        </section>

        <!-- ============================================================
         COMPANY OVERVIEW — dynamic from HomepageAbout
    ============================================================ -->
        <section v-if="about" class="bg-white py-20">
            <div class="max-w-screen-xl mx-auto px-4">
                <h1
                    v-if="about.section_title"
                    class="text-3xl md:text-4xl font-semibold text-slate-900 text-center mb-12"
                >
                    {{ about.section_title }}
                </h1>

                <!-- Top header block -->
                <div class="mb-10 lg:w-[70%]">
                    <h2
                        class="text-2xl md:text-3xl font-bold text-slate-900 leading-tight"
                    >
                        {{ about.title }}
                    </h2>
                    <p
                        v-if="about.description"
                        class="md:text-xl text-slate-500 mt-4 leading-relaxed"
                    >
                        {{ about.description }}
                    </p>
                </div>

                <!-- Image + Overlay Card -->
                <div class="relative">
                    <!-- Image -->
                    <div
                        class="ml-auto w-full lg:w-[70%] overflow-hidden bg-gray-100"
                    >
                        <img
                            v-if="about.image"
                            :src="`/storage/${about.image}`"
                            :alt="about.title"
                            class="w-full h-[420px] lg:h-[480px] object-cover"
                        />
                        <div
                            v-else
                            class="w-full h-[420px] lg:h-[480px] flex items-center justify-center"
                        >
                            <svg
                                class="w-16 h-16 text-gray-200"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>
                        </div>
                    </div>

                    <!-- Overlay card -->
                    <div
                        class="bg-white shadow-xl p-8 w-full lg:absolute lg:left-0 lg:top-1/2 lg:-translate-y-1/2 lg:w-[36%] z-10"
                    >
                        <h3
                            v-if="about.box_title"
                            class="text-2xl md:text-3xl font-bold text-slate-900 mb-4"
                        >
                            {{ about.box_title }}
                        </h3>
                        <p
                            v-if="about.box_description"
                            class="md:text-xl text-slate-600 leading-relaxed mb-6"
                        >
                            {{ about.box_description }}
                        </p>
                        <a
                            v-if="about.show_cta && about.cta_text"
                            :href="about.cta_url || '#'"
                            class="inline-block border md:border-2 border-orange-600 text-orange-600 md:text-xl font-bold px-5 py-2.5 hover:bg-orange-600 hover:text-white transition-colors duration-200"
                        >
                            {{ about.cta_text }}
                        </a>
                    </div>
                </div>

                <!-- Long description below image -->
                <div
                    v-if="about.long_description"
                    class="mt-12 lg:w-[70%] about-long-desc"
                    v-html="about.long_description"
                ></div>
            </div>
        </section>

        <!-- ============================================================
         INQUIRY / CONTACT FORM SECTION
    ============================================================ -->
        <section id="inquiry" style="background-color: #f2f2f2" class="py-20">
            <div class="max-w-screen-xl mx-auto px-4 lg:px-8">
                <div
                    class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start"
                >
                    <!-- Left: Info -->
                    <div>
                        <h2
                            class="text-xl md:text-3xl font-black text-slate-900 leading-tight mb-5"
                        >
                            Kami siap membantu Anda.
                        </h2>
                        <p
                            class="text-slate-500 leading-relaxed mb-10 md:text-xl"
                        >
                            Apakah Anda memiliki pertanyaan atau membutuhkan
                            saran personal? Tim ahli kami siap membantu Anda
                            menemukan solusi yang tepat — secara individual dan
                            cepat.
                        </p>

                        <!-- CTA Phone -->
                        <h3
                            class="text-lg md:text-3xl font-black text-slate-900 mb-1"
                        >
                            Hubungi konsultan kami
                        </h3>
                        <p class="md:text-xl text-slate-500 mb-4">
                            Siap membantu Anda — Senin hingga Jumat
                        </p>
                        <a
                            href="tel:+6221000000"
                            class="inline-flex items-center gap-3 bg-orange-600 hover:bg-orange-700 text-white md:text-xl font-bold px-6 py-3 transition-colors duration-200 mb-12"
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

                        <!-- Process steps -->
                        <h3
                            class="text-lg md:text-3xl font-black text-slate-900 mb-4"
                        >
                            Apa yang terjadi setelah pengiriman?
                        </h3>
                        <ol class="space-y-2.5">
                            <li class="md:text-xl text-slate-500 italic">
                                1. Anda akan menerima konfirmasi otomatis
                                melalui email
                            </li>
                            <li class="md:text-xl text-slate-500 italic">
                                2. Permintaan Anda akan ditinjau oleh tim ahli
                                kami
                            </li>
                            <li class="md:text-xl text-slate-500 italic">
                                3. Anda akan mendapat respons personal dalam
                                1×24 jam kerja
                            </li>
                        </ol>
                    </div>

                    <!-- Right: Form -->
                    <div class="bg-white p-5 sm:p-8 lg:p-10">
                        <h3
                            class="text-xl md:text-3xl font-black text-slate-900 mb-5"
                        >
                            Gunakan formulir kontak
                        </h3>
                        <p class="md:text-xl text-slate-400 mb-10">
                            Tulis kepada kami — kami akan segera menghubungi
                            Anda
                        </p>
                        <InquiryForm whatsapp-number="6221000000" />
                    </div>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import PublicLayout from "@/Layouts/PublicLayout.vue";
import InquiryForm from "@/Components/Public/InquiryForm.vue";

const props = defineProps({
    sliders: { type: Array, default: () => [] },
    about: { type: Object, default: null },
});

// ── Hero Slider ──────────────────────────────────────────────────
const currentSlide = ref(0);
let autoplayTimer = null;

function nextSlide() {
    currentSlide.value = (currentSlide.value + 1) % props.sliders.length;
    resetAutoplay();
}

function prevSlide() {
    currentSlide.value =
        (currentSlide.value - 1 + props.sliders.length) % props.sliders.length;
    resetAutoplay();
}

function resetAutoplay() {
    clearInterval(autoplayTimer);
    autoplayTimer = setInterval(nextSlide, 5000);
}

onMounted(() => {
    autoplayTimer = setInterval(nextSlide, 5000);
});

onUnmounted(() => {
    clearInterval(autoplayTimer);
});

// ── Service Cards ────────────────────────────────────────────────
const serviceCards = [
    {
        category: "Produk",
        title: "Forklift Baru",
        description:
            "Koleksi forklift terbaru dari merek-merek ternama dunia dengan teknologi terkini.",
        image: "https://picsum.photos/seed/card1/600/400",
    },
    {
        category: "Produk",
        title: "Forklift Sewa",
        description:
            "Solusi sewa forklift fleksibel untuk kebutuhan jangka pendek maupun jangka panjang.",
        image: "https://picsum.photos/seed/card2/600/400",
    },
    {
        category: "Produk",
        title: "Forklift Bekas",
        description:
            "Unit forklift bekas berkualitas dengan harga kompetitif, telah melalui inspeksi ketat.",
        image: "https://picsum.photos/seed/card3/600/400",
    },
    {
        category: "Peralatan",
        title: "Reach Truck",
        description:
            "Reach truck ideal untuk operasional gudang dengan rak tinggi dan lorong sempit.",
        image: "https://picsum.photos/seed/card4/600/400",
    },
    {
        category: "Layanan",
        title: "Servis & Perawatan",
        description:
            "Layanan perawatan berkala dan perbaikan oleh teknisi bersertifikat resmi.",
        image: "https://picsum.photos/seed/card5/600/400",
    },
    {
        category: "Layanan",
        title: "Hubungi Kami",
        description:
            "Konsultasikan kebutuhan material handling Anda dengan tim ahli kami.",
        image: "https://picsum.photos/seed/card6/600/400",
    },
];

// ── Solutions ────────────────────────────────────────────────────
const solutions = [
    {
        title: "Solusi Gudang & Logistik",
        desc: "Sistem material handling terintegrasi untuk efisiensi gudang dan distribusi.",
    },
    {
        title: "Solusi Manufaktur",
        desc: "Peralatan andal untuk lini produksi dengan uptime tinggi dan perawatan mudah.",
    },
    {
        title: "Solusi Cold Storage",
        desc: "Forklift berteknologi khusus untuk operasional di lingkungan suhu rendah.",
    },
];

// ── Stats ────────────────────────────────────────────────────────
const stats = [
    { value: "500+", label: "Klien Aktif" },
    { value: "20+", label: "Tahun Pengalaman" },
    { value: "1200+", label: "Unit Terjual" },
    { value: "24/7", label: "Dukungan Teknis" },
];

// ── News ─────────────────────────────────────────────────────────
const news = [
    {
        category: "Industri",
        date: "15 Mei 2026",
        title: "Tren Otomasi Gudang 2026: Peran Forklift Elektrik",
        excerpt:
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Perkembangan teknologi forklift elektrik semakin mendominasi industri logistik modern.",
        image: "https://picsum.photos/seed/news1/600/400",
    },
    {
        category: "Produk",
        date: "10 Mei 2026",
        title: "Peluncuran Seri Forklift Reach Truck Terbaru 2026",
        excerpt:
            "Kami dengan bangga memperkenalkan seri reach truck generasi terbaru dengan kapasitas angkat hingga 2,5 ton dan efisiensi energi superior.",
        image: "https://picsum.photos/seed/news2/600/400",
    },
    {
        category: "Tips & Panduan",
        date: "05 Mei 2026",
        title: "Panduan Lengkap Perawatan Forklift agar Awet",
        excerpt:
            "Perawatan rutin adalah kunci umur panjang forklift Anda. Berikut panduan lengkap perawatan yang wajib dilakukan setiap bulan.",
        image: "https://picsum.photos/seed/news3/600/400",
    },
];

// ── Brands ───────────────────────────────────────────────────────
const brands = ["TOYOTA", "KOMATSU", "LINDE", "HYSTER", "CROWN", "MITSUBISHI"];
</script>

<style scoped>
/* ── About long description (v-html rendered content) ────── */
.about-long-desc :deep(p) {
    color: #475569;
    line-height: 1.75;
    margin-bottom: 0.75rem;
}
@media (min-width: 768px) {
    .about-long-desc :deep(p) {
        font-size: 20px;
    }
}
.about-long-desc :deep(h3) {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1e293b;
    margin: 1.25rem 0 0.5rem;
}
.about-long-desc :deep(ul) {
    list-style: disc;
    padding-left: 1.25rem;
    color: #475569;
    line-height: 1.75;
    margin-bottom: 0.75rem;
}
.about-long-desc :deep(ol) {
    list-style: decimal;
    padding-left: 1.25rem;
    color: #475569;
    line-height: 1.75;
    margin-bottom: 0.75rem;
}
.about-long-desc :deep(strong) {
    font-weight: 700;
}
.about-long-desc :deep(em) {
    font-style: italic;
}

/* ── Hero transitions ─────────────────────────────────────── */
.hero-fade-enter-active,
.hero-fade-leave-active {
    transition: opacity 0.8s ease;
}
.hero-fade-enter-from,
.hero-fade-leave-to {
    opacity: 0;
}

/* ── Hero responsive layout ──────────────────────────────── */

/* Mobile default */
.hero-section {
    height: 560px;
}

.hero-left-col {
    width: 100%;
    padding: 2.5rem 1.5rem 2rem;
}

.hero-right-col {
    width: 100%;
    height: 240px;
    flex-shrink: 0;
}

/* Dots: mobile — centered, overlaid on bottom of image */
.hero-dots {
    position: absolute;
    bottom: 1rem;
    left: 50%;
    transform: translateX(-50%);
}

/* Desktop (md: 768px+) */
@media (min-width: 768px) {
    .hero-section {
        height: 510px;
    }

    .hero-left-col {
        width: 45%;
        flex-shrink: 0;
        padding-top: 0;
        padding-bottom: 4rem;
        padding-right: 3rem;
        padding-left: max(calc((100vw - 80rem) / 2 + 1.5rem), 1.5rem);
    }

    .hero-right-col {
        flex: 1;
        height: auto;
    }

    /* Dots: desktop — bottom left, sejajar dengan teks */
    .hero-dots {
        left: max(calc((100vw - 80rem) / 2 + 1.5rem), 1.5rem);
        bottom: 1.5rem;
        transform: none;
    }
}
</style>
