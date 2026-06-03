<template>
    <PublicLayout>
        <Head :title="page.title" />

        <!-- Breadcrumb -->
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-screen-xl mx-auto px-4 py-3 flex items-center gap-2 text-sm text-gray-400">
                <a href="/" class="hover:text-orange-600 transition-colors duration-150">Home</a>

                <!-- Nav group (e.g. "Perusahaan") -->
                <template v-if="breadcrumbGroup">
                    <span>›</span>
                    <a v-if="breadcrumbGroup.href" :href="breadcrumbGroup.href"
                        class="hover:text-orange-600 transition-colors duration-150">
                        {{ breadcrumbGroup.label }}
                    </a>
                    <span v-else>{{ breadcrumbGroup.label }}</span>
                </template>

                <!-- Nav sub (e.g. "Keberlanjutan") -->
                <template v-if="breadcrumbSub">
                    <span>›</span>
                    <a v-if="breadcrumbSub.href" :href="breadcrumbSub.href"
                        class="hover:text-orange-600 transition-colors duration-150">
                        {{ breadcrumbSub.label }}
                    </a>
                    <span v-else>{{ breadcrumbSub.label }}</span>
                </template>

                <span>›</span>
                <span class="text-slate-600 font-medium truncate max-w-[200px] md:max-w-xs">{{ page.title }}</span>
            </div>
        </div>

        <!-- ============================================================
             HERO SECTION — Split layout: 45% text | 55% image (non-slider)
        ============================================================ -->
        <section
            class="relative w-full bg-white overflow-hidden hero-section border-b border-b-gray-100"
        >
            <div class="w-full flex flex-col md:flex-row h-full">
                <!-- Col Left -->
                <div class="hero-left-col flex flex-col justify-center">
                    <div class="inline-flex items-center gap-2 mb-5">
                        <span class="w-6 h-0.5 bg-orange-600"></span>
                        <span
                            class="text-xs font-bold text-orange-600 uppercase tracking-widest"
                        >
                            {{ page.label }}
                        </span>
                    </div>
                    <h1
                        class="text-3xl lg:text-4xl xl:text-[2.6rem] font-bold text-slate-900 leading-tight mb-4"
                    >
                        {{ page.title }}
                    </h1>
                    <p
                        v-if="page.subtitle"
                        class="lg:text-2xl text-slate-500 leading-relaxed mb-8"
                    >
                        {{ page.subtitle }}
                    </p>
                    <div v-if="page.cta_text">
                        <a
                            :href="page.cta_url || '#'"
                            class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white md:text-xl font-bold px-6 py-3 transition-colors duration-200"
                        >
                            {{ page.cta_text }}
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
                        v-if="page.image"
                        :src="page.image"
                        :alt="page.title"
                        class="w-full h-full object-cover"
                    />
                    <div
                        v-else
                        class="w-full h-full flex items-center justify-center"
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
            </div>
        </section>

        <!-- ============================================================
             TITLE SECTION — Statement banner (sama seperti Home.vue)
        ============================================================ -->
        <section class="bg-white pt-14 pb-20">
            <div class="max-w-screen-xl mx-auto px-4">
                <h2
                    class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 leading-tight md:leading-[60px] lg:leading-[68px] max-w-4xl"
                >
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

        <!-- INQUIRY / CONTACT FORM SECTION -->
        <InquirySection v-if="page.show_inquiry" />
    </PublicLayout>
</template>

<script setup>
import { computed } from "vue";
import { Head, usePage } from "@inertiajs/vue3";
import PublicLayout from "@/Layouts/PublicLayout.vue";
import InquirySection from "@/Components/Public/InquirySection.vue";

const props = defineProps({
    page: {
        type: Object,
        default: () => ({
            title: "Tentang Kami",
            label: "Perusahaan",
            subtitle:
                "Mitra terpercaya dalam solusi material handling industri sejak 2004.",
            image: "https://picsum.photos/seed/page-hero/1200/600",
            cta_text: "Hubungi Kami",
            cta_url: "/#inquiry",
            heading:
                "Lebih dari dua dekade menggerakkan industri Indonesia dengan solusi forklift terdepan.",
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

const navStructure = computed(() => usePage().props.nav_structure ?? []);

const breadcrumbGroup = computed(() => {
    if (!props.page?.nav_group) return null;
    const item = navStructure.value.find(i => i.label === props.page.nav_group);
    return item ? { label: item.label, href: item.href ?? null } : { label: props.page.nav_group, href: null };
});

const breadcrumbSub = computed(() => {
    if (!props.page?.nav_sub || !breadcrumbGroup.value) return null;
    const parent = navStructure.value.find(i => i.label === props.page.nav_group);
    const sub = parent?.subItems?.find(s => s.label === props.page.nav_sub);
    return sub ? { label: sub.label, href: sub.href ?? null } : { label: props.page.nav_sub, href: null };
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
