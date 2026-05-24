<?php

namespace Database\Seeders;

use App\Models\HeroSlider;
use Illuminate\Database\Seeder;

class HeroSliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'label'       => 'Produk',
                'title'       => 'Forklift Baru',
                'description' => 'Koleksi forklift terbaru dari merek-merek ternama dunia dengan teknologi terkini.',
                'show_cta'    => true,
                'cta_text'    => 'Lihat Produk',
                'cta_url'     => '/produk',
                'image'       => 'sliders/KyjWEO4meLl7cUFRzXEAebGG4lHTaG0AV2OuNQKc.webp',
                'order'       => 1,
                'is_active'   => true,
            ],
            [
                'label'       => 'Produk',
                'title'       => 'Forklift Sewa',
                'description' => 'Solusi sewa forklift fleksibel untuk kebutuhan jangka pendek maupun jangka panjang.',
                'show_cta'    => true,
                'cta_text'    => 'Hubungi Kami',
                'cta_url'     => '/kontak',
                'image'       => 'sliders/OpB4KCj69ehJHWgEYWp1PJUL7N21SgNudYTaOrf4.webp',
                'order'       => 2,
                'is_active'   => true,
            ],
            [
                'label'       => 'Produk',
                'title'       => 'Forklift Bekas',
                'description' => 'Unit forklift bekas berkualitas dengan harga kompetitif, telah melalui inspeksi ketat.',
                'show_cta'    => false,
                'cta_text'    => null,
                'cta_url'     => null,
                'image'       => 'sliders/vDbvOCSOyAGHc3hnAAUxLY7Go46Yr9Z7Tyw8Knlb.webp',
                'order'       => 3,
                'is_active'   => true,
            ],
        ];

        foreach ($sliders as $data) {
            HeroSlider::create($data);
        }
    }
}
