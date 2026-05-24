<?php

namespace Database\Seeders;

use App\Models\HomepageAbout;
use Illuminate\Database\Seeder;

class HomepageAboutSeeder extends Seeder
{
    public function run(): void
    {
        HomepageAbout::create([
            'section_title'   => 'Tentang Perusahaan',
            'title'           => 'Mitra terpercaya solusi material handling industri Indonesia',
            'description'     => 'Kami mengimplementasikan pengelolaan cerdas peralatan material handling, perangkat lunak, dan layanan untuk berbagai industri besar di Indonesia.',
            'box_title'       => 'Distributor Forklift',
            'box_description' => 'Kami adalah distributor forklift terpercaya dengan pengalaman lebih dari 20 tahun melayani berbagai industri besar. Tim teknisi bersertifikat kami siap memastikan operasional bisnis Anda berjalan optimal.',
            'image'           => 'homepage/EWpzEYDhfeSmrozEj3rX7yErSTMXWRqSgEYrDyRS.webp',
            'show_cta'        => true,
            'cta_text'        => 'Tentang Kami',
            'cta_url'         => '/tentang-kami',
            'long_description'=> '<p>Kami memiliki rekam jejak panjang dalam penyediaan forklift berkualitas tinggi dari merek-merek ternama dunia. Setiap unit yang kami distribusikan telah melalui proses inspeksi ketat untuk memastikan performa terbaik.</p><p>Dengan armada produk lengkap mulai dari forklift baru, sewa, hingga bekas berkualitas, serta layanan purna jual dan servis resmi, kami siap menjadi mitra material handling jangka panjang bisnis Anda.</p>',
        ]);
    }
}
