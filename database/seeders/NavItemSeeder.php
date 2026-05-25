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
                'label' => 'Produk',
                'href'  => null,
                'subs'  => [
                    ['label' => 'Forklift Baru', 'children' => ['Forklift Elektrik', 'Forklift Diesel', 'Forklift LPG', 'Forklift 4 Roda', 'Forklift 3 Roda', 'Forklift Heavy Duty']],
                    ['label' => 'Forklift Sewa', 'children' => ['Sewa Harian', 'Sewa Bulanan', 'Sewa Tahunan', 'Sewa dengan Operator']],
                    ['label' => 'Forklift Bekas', 'children' => ['Unit Bekas Terinspeksi', 'Garansi Terbatas', 'Trade-In Program']],
                    ['label' => 'Reach Truck', 'children' => ['Reach Truck Standar', 'Double Deep Reach', 'Narrow Aisle Reach']],
                    ['label' => 'Hand Pallet & Order Picker', 'children' => ['Hand Pallet Manual', 'Hand Pallet Elektrik', 'Low Level Order Picker', 'High Level Order Picker']],
                    ['label' => 'Semua Produk', 'children' => []],
                ],
            ],
            [
                'label' => 'Solusi',
                'href'  => null,
                'subs'  => [
                    ['label' => 'Gudang & Logistik', 'children' => ['Penerimaan Barang', 'Order Picking', 'Pengemasan & Pengiriman', 'Optimasi Storage', 'Supply Produksi', 'Barang Keluar']],
                    ['label' => 'Manufaktur', 'children' => ['Lini Produksi', 'Material Supply', 'Pengangkutan Internal', 'Waste Management']],
                    ['label' => 'Cold Storage', 'children' => ['Forklift Suhu Rendah', 'Freezer Warehouse', 'Pharmaceutical Storage']],
                    ['label' => 'Retail & Distribusi', 'children' => ['Cross Docking', 'Sortasi & Distribusi', 'Last-Mile Support']],
                    ['label' => 'Konstruksi & Berat', 'children' => ['Forklift Outdoor', 'Rough Terrain', 'Heavy Load Solution']],
                ],
            ],
            [
                'label' => 'Layanan',
                'href'  => null,
                'subs'  => [
                    ['label' => 'Perawatan & Servis', 'children' => ['Servis Berkala', 'Servis Darurat', 'Perawatan Preventif', 'Overhaul']],
                    ['label' => 'Suku Cadang', 'children' => ['Suku Cadang Original', 'Fast Moving Parts', 'Pemesanan Online']],
                    ['label' => 'Pelatihan Operator', 'children' => ['Sertifikasi Operator', 'Safety Training', 'In-House Training']],
                    ['label' => 'Konsultasi Teknis', 'children' => ['Analisa Kebutuhan', 'Fleet Management', 'Konsultasi On-Site']],
                ],
            ],
            [
                'label' => 'Berita',
                'href'  => '/berita',
                'subs'  => [],
            ],
            [
                'label' => 'Perusahaan',
                'href'  => null,
                'subs'  => [
                    ['label' => 'Tentang Kami', 'children' => ['Sejarah Perusahaan', 'Visi & Misi', 'Sertifikasi & Penghargaan']],
                    ['label' => 'Mitra & Merek', 'children' => []],
                    ['label' => 'Karir', 'children' => ['Lowongan Kerja', 'Budaya Kerja', 'Benefit Karyawan']],
                ],
            ],
            [
                'label' => 'Kontak',
                'href'  => null,
                'subs'  => [],
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
                    'href'       => $sub['href'] ?? null,
                    'sort_order' => $subOrder + 1,
                ]);

                foreach ($sub['children'] as $childOrder => $child) {
                    NavItem::create([
                        'parent_id'  => $subItem->id,
                        'level'      => 3,
                        'label'      => $child,
                        'href'       => null,
                        'sort_order' => $childOrder + 1,
                    ]);
                }
            }
        }
    }
}

