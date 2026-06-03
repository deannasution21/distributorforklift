<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $reachTruck   = ProductCategory::where('slug', 'reach-truck')->first();
        $counter      = ProductCategory::where('slug', 'counterbalance')->first();
        $palletTruck  = ProductCategory::where('slug', 'electric-pallet-truck')->first();
        $orderPicker  = ProductCategory::where('slug', 'order-picker')->first();

        $products = [
            // Reach Truck
            [
                'product_category_id' => $reachTruck->id,
                'name'              => 'Reach Truck 1.4 Ton',
                'slug'              => 'reach-truck-14-ton',
                'short_description' => 'Reach truck listrik kompak untuk lorong sempit, kapasitas 1.4 ton.',
                'specs'             => [
                    ['label' => 'Kapasitas Angkat', 'value' => '1.400 kg'],
                    ['label' => 'Tinggi Angkat Maks', 'value' => '9.500 mm'],
                    ['label' => 'Lebar Lorong Min', 'value' => '2.700 mm'],
                ],
                'is_active' => true,
            ],
            [
                'product_category_id' => $reachTruck->id,
                'name'              => 'Reach Truck 2.0 Ton',
                'slug'              => 'reach-truck-20-ton',
                'short_description' => 'Reach truck bertenaga tinggi untuk beban berat dan rak tinggi.',
                'specs'             => [
                    ['label' => 'Kapasitas Angkat', 'value' => '2.000 kg'],
                    ['label' => 'Tinggi Angkat Maks', 'value' => '11.000 mm'],
                    ['label' => 'Lebar Lorong Min', 'value' => '2.900 mm'],
                ],
                'is_active' => true,
            ],
            // Counterbalance
            [
                'product_category_id' => $counter->id,
                'name'              => 'Counterbalance 2.5 Ton',
                'slug'              => 'counterbalance-25-ton',
                'short_description' => 'Forklift counterbalance serbaguna, cocok untuk berbagai kondisi industri.',
                'specs'             => [
                    ['label' => 'Kapasitas Angkat', 'value' => '2.500 kg'],
                    ['label' => 'Tinggi Angkat Maks', 'value' => '4.700 mm'],
                    ['label' => 'Kecepatan Jalan', 'value' => '19 km/h'],
                ],
                'is_active' => true,
            ],
            [
                'product_category_id' => $counter->id,
                'name'              => 'Counterbalance 3.5 Ton',
                'slug'              => 'counterbalance-35-ton',
                'short_description' => 'Kapasitas angkat besar untuk material handling berat.',
                'specs'             => [
                    ['label' => 'Kapasitas Angkat', 'value' => '3.500 kg'],
                    ['label' => 'Tinggi Angkat Maks', 'value' => '5.000 mm'],
                    ['label' => 'Kecepatan Jalan', 'value' => '18 km/h'],
                ],
                'is_active' => true,
            ],
            // Electric Pallet Truck
            [
                'product_category_id' => $palletTruck->id,
                'name'              => 'Electric Pallet Truck 2.0 Ton',
                'slug'              => 'electric-pallet-truck-20-ton',
                'short_description' => 'Pallet truck listrik efisien untuk distribusi dan area sempit.',
                'specs'             => [
                    ['label' => 'Kapasitas Angkat', 'value' => '2.000 kg'],
                    ['label' => 'Tinggi Angkat Maks', 'value' => '200 mm'],
                    ['label' => 'Kecepatan Jalan', 'value' => '6 km/h'],
                ],
                'is_active' => true,
            ],
            // Order Picker
            [
                'product_category_id' => $orderPicker->id,
                'name'              => 'Order Picker 1.0 Ton',
                'slug'              => 'order-picker-10-ton',
                'short_description' => 'Solusi order picking untuk gudang bertingkat, platform operator naik.',
                'specs'             => [
                    ['label' => 'Kapasitas Angkat', 'value' => '1.000 kg'],
                    ['label' => 'Tinggi Angkat Maks', 'value' => '10.000 mm'],
                    ['label' => 'Lebar Lorong Min', 'value' => '1.800 mm'],
                ],
                'is_active' => true,
            ],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }
    }
}
