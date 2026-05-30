<?php

namespace Database\Seeders;

use App\Models\HomepageShowcase;
use Illuminate\Database\Seeder;

class HomepageShowcaseSeeder extends Seeder
{
    public function run(): void
    {
        HomepageShowcase::truncate();

        $items = [
            [
                'row'         => 1,
                'position'    => 1,
                'title'       => 'Forklift Baru',
                'description' => 'Solusi forklift baru dengan performa andal untuk mendukung operasional bisnis Anda.',
                'image'       => 'showcase/QZxEqZ6TKdUUw1EJSzunzqCiPkZS5IIsjsBrDHiY.webp',
                'href'        => '/forklift-baru',
            ],
            [
                'row'         => 1,
                'position'    => 2,
                'title'       => 'Sewa Forklift',
                'description' => 'Layanan sewa forklift yang fleksibel dan efisien sesuai kebutuhan operasional.',
                'image'       => 'showcase/m6zU8UvymhqiiR6xhfnTv4AORi9SF7TpzxZ9ECvX.webp',
                'href'        => '/forklift-sewa',
            ],
            [
                'row'         => 1,
                'position'    => 3,
                'title'       => 'Otomasi di Logistik',
                'description' => 'Tingkatkan efisiensi logistik dengan solusi otomasi yang modern dan terintegrasi.',
                'image'       => 'showcase/b5LA48GkWf24paqlZUvczTBWXDkUMzqqavHCE8ct.webp',
                'href'        => '/otomasi-logistik',
            ],
            [
                'row'         => 2,
                'position'    => 1,
                'title'       => 'Konsultansi Racking bersama Distributor Forklift',
                'description' => 'Solusi konsultasi racking untuk tata gudang yang lebih aman, rapi, dan efisien.',
                'image'       => 'showcase/WG7QUQcdYkwl1xRgvOkdHTmG94yQBHONQQ5j9ES3.webp',
                'href'        => null,
            ],
            [
                'row'         => 2,
                'position'    => 2,
                'title'       => 'Sistem Intralogistik',
                'description' => 'Integrasi sistem intralogistik untuk mendukung alur kerja yang lebih produktif dan optimal.',
                'image'       => 'showcase/g1qsTxs6cWkFxGIXVW7O0dMXbrGciPWP4Z7lThvF.webp',
                'href'        => null,
            ],
            [
                'row'         => 2,
                'position'    => 3,
                'title'       => null,
                'description' => null,
                'image'       => null,
                'href'        => null,
            ],
            [
                'row'         => 3,
                'position'    => 1,
                'title'       => 'Servis',
                'description' => 'Layanan servis dan perawatan forklift untuk menjaga performa tetap optimal.',
                'image'       => 'showcase/ztgIvBicLAf7Y6PuuxqRHlpb9Rf1I5rq47EbgUTx.webp',
                'href'        => null,
            ],
            [
                'row'         => 3,
                'position'    => 2,
                'title'       => 'Kontak',
                'description' => 'Hubungi tim kami untuk konsultasi dan solusi sesuai kebutuhan bisnis Anda.',
                'image'       => 'showcase/f7LUDBGOOUUuUfuOtawCu6fMR8rC4k6MpuAIFzLm.webp',
                'href'        => null,
            ],
            [
                'row'         => 3,
                'position'    => 3,
                'title'       => null,
                'description' => null,
                'image'       => null,
                'href'        => null,
            ],
        ];

        foreach ($items as $item) {
            HomepageShowcase::create($item);
        }
    }
}
