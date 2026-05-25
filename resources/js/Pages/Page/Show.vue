<template>
    <PublicLayout>
        <Head :title="page.title" />

        <!-- ============================================================
             HERO SECTION — Split layout: 45% text | 55% image (non-slider)
        ============================================================ -->
        <section class="relative w-full bg-white overflow-hidden hero-section border-b border-b-gray-100">
            <div class="w-full flex flex-col md:flex-row h-full">
                <!-- Col Left -->
                <div class="hero-left-col flex flex-col justify-center">
                    <div class="inline-flex items-center gap-2 mb-5">
                        <span class="w-6 h-0.5 bg-orange-600"></span>
                        <span class="text-xs font-bold text-orange-600 uppercase tracking-widest">
                            {{ page.label }}
                        </span>
                    </div>
                    <h1 class="text-3xl lg:text-4xl xl:text-[2.6rem] font-bold text-slate-900 leading-tight mb-4">
                        {{ page.title }}
                    </h1>
                    <p v-if="page.subtitle" class="lg:text-2xl text-slate-500 leading-relaxed mb-8">
                        {{ page.subtitle }}
                    </p>
                    <div v-if="page.cta_text">
                        <a
                            :href="page.cta_url || '#'"
                            class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white md:text-xl font-bold px-6 py-3 transition-colors duration-200"
                        >
                            {{ page.cta_text }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Col Right -->
                <div class="hero-right-col overflow-hidden bg-gray-100 relative">
                    <img
                        v-if="page.image"
                        :src="page.image"
                        :alt="page.title"
                        class="w-full h-full object-cover"
                    />
                    <div
                        v-else
                        class="w-full h-full flex items-center justify-center"
                    >
                        <svg class="w-16 h-16 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================
             TITLE SECTION — Statement banner (sama seperti Home.vue)
        ============================================================ -->
        <section class="bg-white pt-14 pb-20">
            <div class="max-w-screen-xl mx-auto px-4">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 leading-tight md:leading-[60px] lg:leading-[68px] max-w-4xl">
                    {{ page.heading }}
                </h2>
            </div>
        </section>

        <!-- ============================================================
             DESCRIPTION SECTION — Rich text content dari backend
        ============================================================ -->
        <section class="bg-white pb-24">
            <div class="max-w-screen-xl mx-auto px-4">
                <div class="max-w-4xl page-content" v-html="page.content"></div>
            </div>
        </section>

        <!-- ============================================================
             INQUIRY / CONTACT FORM SECTION
        ============================================================ -->
        <section v-if="page.show_inquiry" id="inquiry" style="background-color: #f2f2f2" class="py-20">
            <div class="max-w-screen-xl mx-auto px-4 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">
                    <!-- Left: Info -->
                    <div>
                        <h2 class="text-xl md:text-3xl font-black text-slate-900 leading-tight mb-5">
                            Kami siap membantu Anda.
                        </h2>
                        <p class="text-slate-500 leading-relaxed mb-10 md:text-xl">
                            Apakah Anda memiliki pertanyaan atau membutuhkan
                            saran personal? Tim ahli kami siap membantu Anda
                            menemukan solusi yang tepat — secara individual dan
                            cepat.
                        </p>

                        <!-- CTA Phone -->
                        <h3 class="text-lg md:text-3xl font-black text-slate-900 mb-1">
                            Hubungi konsultan kami
                        </h3>
                        <p class="md:text-xl text-slate-500 mb-4">
                            Siap membantu Anda — Senin hingga Jumat
                        </p>
                        <a
                            href="tel:+6221000000"
                            class="inline-flex items-center gap-3 bg-orange-600 hover:bg-orange-700 text-white md:text-xl font-bold px-6 py-3 transition-colors duration-200 mb-12"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            +62 21 000 0000
                        </a>

                        <!-- Process steps -->
                        <h3 class="text-lg md:text-3xl font-black text-slate-900 mb-4">
                            Apa yang terjadi setelah pengiriman?
                        </h3>
                        <ol class="space-y-2.5">
                            <li class="md:text-xl text-slate-500 italic">
                                1. Anda akan menerima konfirmasi otomatis melalui email
                            </li>
                            <li class="md:text-xl text-slate-500 italic">
                                2. Permintaan Anda akan ditinjau oleh tim ahli kami
                            </li>
                            <li class="md:text-xl text-slate-500 italic">
                                3. Anda akan mendapat respons personal dalam 1×24 jam kerja
                            </li>
                        </ol>
                    </div>

                    <!-- Right: Form -->
                    <div class="bg-white p-5 sm:p-8 lg:p-10">
                        <h3 class="text-xl md:text-3xl font-black text-slate-900 mb-5">
                            Gunakan formulir kontak
                        </h3>
                        <p class="md:text-xl text-slate-400 mb-10">
                            Tulis kepada kami — kami akan segera menghubungi Anda
                        </p>
                        <InquiryForm whatsapp-number="6221000000" />
                    </div>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import PublicLayout from "@/Layouts/PublicLayout.vue";
import InquiryForm from "@/Components/Public/InquiryForm.vue";

defineProps({
    page: {
        type: Object,
        default: () => ({
            title: "Tentang Kami",
            label: "Perusahaan",
            subtitle: "Mitra terpercaya dalam solusi material handling industri sejak 2004.",
            image: "https://picsum.photos/seed/page-hero/1200/600",
            cta_text: "Hubungi Kami",
            cta_url: "/#inquiry",
            heading: "Lebih dari dua dekade menggerakkan industri Indonesia dengan solusi forklift terdepan.",
            show_inquiry: true,
            content: `
                <p>Kami adalah distributor forklift terkemuka di Indonesia yang telah melayani berbagai sektor industri selama lebih dari 20 tahun. Dengan portofolio produk dari merek-merek global terpercaya, kami hadir memberikan solusi material handling yang tepat untuk setiap kebutuhan operasional bisnis Anda.</p>
                <h3>Visi Kami</h3>
                <p>Menjadi mitra material handling pilihan utama bagi industri Indonesia — memberikan produk berkualitas, layanan purna jual terbaik, dan solusi yang meningkatkan produktivitas operasional klien kami.</p>
                <h3>Misi Kami</h3>
                <ul>
                    <li>Menyediakan forklift dan peralatan material handling berkualitas tinggi dari merek global terpercaya</li>
                    <li>Memberikan layanan konsultasi yang profesional dan personal untuk setiap klien</li>
                    <li>Memastikan ketersediaan suku cadang dan layanan purna jual yang cepat dan andal</li>
                    <li>Mendukung pertumbuhan industri Indonesia dengan solusi yang efisien dan berkelanjutan</li>
                </ul>
                <h3>Mengapa Memilih Kami?</h3>
                <p>Dengan jaringan yang luas, tim teknisi bersertifikat, dan rekam jejak yang terbukti, kami siap menjadi partner jangka panjang untuk kebutuhan material handling perusahaan Anda.</p>
            `,
        }),
    },
});
</script>

<style scoped>
/* ── Hero responsive layout (sama persis dengan Home.vue) ── */
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
}

/* ── Page content (v-html) typography ── */
.page-content :deep(p) {
    color: #475569;
    line-height: 1.8;
    margin-bottom: 1.25rem;
    font-size: 1rem;
}
@media (min-width: 768px) {
    .page-content :deep(p) {
        font-size: 1.125rem;
    }
}
.page-content :deep(h2) {
    font-size: 1.75rem;
    font-weight: 800;
    color: #0f172a;
    margin: 2.5rem 0 1rem;
    line-height: 1.3;
}
.page-content :deep(h3) {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
    margin: 2rem 0 0.75rem;
    line-height: 1.4;
}
.page-content :deep(ul),
.page-content :deep(ol) {
    padding-left: 1.5rem;
    color: #475569;
    line-height: 1.8;
    margin-bottom: 1.25rem;
}
.page-content :deep(ul) {
    list-style: disc;
}
.page-content :deep(ol) {
    list-style: decimal;
}
.page-content :deep(li) {
    margin-bottom: 0.5rem;
    font-size: 1rem;
}
@media (min-width: 768px) {
    .page-content :deep(li) {
        font-size: 1.125rem;
    }
}
.page-content :deep(strong) {
    font-weight: 700;
    color: #1e293b;
}
.page-content :deep(em) {
    font-style: italic;
}
.page-content :deep(a) {
    color: #ea580c;
    text-decoration: underline;
}
.page-content :deep(blockquote) {
    border-left: 4px solid #ea580c;
    padding-left: 1.25rem;
    color: #64748b;
    font-style: italic;
    margin: 1.5rem 0;
}
</style>
