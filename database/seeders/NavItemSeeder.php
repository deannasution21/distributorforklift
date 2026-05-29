<?php

namespace Database\Seeders;

use App\Models\NavItem;
use Illuminate\Database\Seeder;

class NavItemSeeder extends Seeder
{
    public function run(): void
    {
        NavItem::truncate();

        $structure = [
            [
                'label' => 'Keahlian Kami',
                'href'  => null,
                'subs'  => [
                    ['label' => 'Logistik Pintar',                            'href' => null, 'children' => []],
                    ['label' => 'Aplikasi pada Industri',                     'href' => null, 'children' => []],
                    ['label' => 'Sistem Energi untuk Intralogistik',          'href' => null, 'children' => []],
                    ['label' => 'Solusi Digital dari Distributor Forklift',   'href' => null, 'children' => []],
                    ['label' => 'Referensi',                                  'href' => null, 'children' => []],
                    ['label' => 'Penghargaan',                                'href' => null, 'children' => []],
                ],
            ],
            [
                'label' => 'Forklift',
                'href'  => null,
                'subs'  => [
                    ['label' => 'Forklift Baru',                              'href' => null, 'children' => []],
                    ['label' => 'Sewa Forklift',                              'href' => null, 'children' => []],
                    ['label' => 'Fitur Tambahan',                             'href' => null, 'children' => []],
                    ['label' => 'Teknologi Distributor Forklift Li-Ion',      'href' => null, 'children' => []],
                    ['label' => 'Lini Produk',                                'href' => null, 'children' => []],
                ],
            ],
            [
                'label' => 'Sistem Intralogistik',
                'href'  => null,
                'subs'  => [
                    ['label' => 'Otomasi',                                    'href' => null, 'children' => []],
                    ['label' => 'Narrow Aisle Trucks',                        'href' => null, 'children' => []],
                    ['label' => 'Fleet Solutions',                            'href' => null, 'children' => []],
                ],
            ],
            [
                'label' => 'Layanan Purna Jual',
                'href'  => null,
                'subs'  => [
                    ['label' => 'Servis dan Perbaikan',                       'href' => null, 'children' => []],
                    ['label' => 'Kontrak Servis',                             'href' => null, 'children' => []],
                    ['label' => 'Keamanan',                                   'href' => null, 'children' => []],
                    ['label' => 'Pelatihan Operator',                         'href' => null, 'children' => []],
                    ['label' => 'Aksesoris',                                  'href' => null, 'children' => []],
                    ['label' => 'Distributor Forklift Original Parts®',       'href' => null, 'children' => []],
                    ['label' => 'Servis untuk Sistem Otomatis',               'href' => null, 'children' => []],
                    ['label' => 'Servis untuk Sistem Energi',                 'href' => null, 'children' => []],
                ],
            ],
            [
                'label' => 'Perusahaan',
                'href'  => null,
                'subs'  => [
                    ['label' => 'Keberlanjutan',                              'href' => null,      'children' => []],
                    ['label' => 'Tentang Kami',                               'href' => null,      'children' => []],
                    ['label' => '3 Tahun Distributor Forklift',               'href' => null,      'children' => []],
                    ['label' => 'Kontak dan Lokasi',                          'href' => '/kontak', 'children' => []],
                    ['label' => 'Berita',                                     'href' => '/berita', 'children' => []],
                    ['label' => 'Partner',                                    'href' => null,      'children' => []],
                    ['label' => 'Sertifikasi',                                'href' => null,      'children' => []],
                ],
            ],
        ];

        foreach ($structure as $mainOrder => $main) {
            $mainItem = NavItem::create([
                'parent_id'  => null,
                'level'      => 1,
                'label'      => $main['label'],
                'href'       => $main['href'],
                'sort_order' => $mainOrder + 1,
            ]);

            foreach ($main['subs'] as $subOrder => $sub) {
                $subItem = NavItem::create([
                    'parent_id'  => $mainItem->id,
                    'level'      => 2,
                    'label'      => $sub['label'],
                    'href'       => $sub['href'],
                    'sort_order' => $subOrder + 1,
                ]);

                foreach ($sub['children'] as $childOrder => $child) {
                    NavItem::create([
                        'parent_id'  => $subItem->id,
                        'level'      => 3,
                        'label'      => is_array($child) ? $child['label'] : $child,
                        'href'       => is_array($child) ? ($child['href'] ?? null) : null,
                        'sort_order' => $childOrder + 1,
                    ]);
                }
            }
        }
    }
}
