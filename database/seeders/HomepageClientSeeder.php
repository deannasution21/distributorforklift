<?php

namespace Database\Seeders;

use App\Models\HomepageClient;
use Illuminate\Database\Seeder;

class HomepageClientSeeder extends Seeder
{
    public function run(): void
    {
        HomepageClient::truncate();

        $clients = [
            [
                'name'       => 'PT. Logistik Nusantara',
                'logo'       => 'clients/wzuhXaDgliC2MmrGRKzJxE2whIqUUkEdhCMDkg6L.jpg',
                'website'    => null,
                'sort_order' => 1,
                'is_active'  => true,
            ],
            [
                'name'       => 'CV. Maju Bersama',
                'logo'       => 'clients/uSW8rzLxu914V5GzNGxdbspTufETNa8xHZJXcAmv.jpg',
                'website'    => null,
                'sort_order' => 2,
                'is_active'  => true,
            ],
            [
                'name'       => 'PT. Industri Prima',
                'logo'       => 'clients/VhYnAb94HEk1QSLvWty9kzxdoV5znK23dZyc34mx.jpg',
                'website'    => null,
                'sort_order' => 3,
                'is_active'  => true,
            ],
            [
                'name'       => 'PT. Artha Sentosa',
                'logo'       => 'clients/rkagmsJhHmV9L3ooI3q2HPqRLJp2Mn31BZ37DWeI.webp',
                'website'    => null,
                'sort_order' => 4,
                'is_active'  => true,
            ],
            [
                'name'       => 'CV. Trijaya Mandiri',
                'logo'       => 'clients/bP4VqJaqeXrUCdJ177dyCOiV0AvkRRV1bkFlwRfU.webp',
                'website'    => null,
                'sort_order' => 5,
                'is_active'  => true,
            ],
        ];

        foreach ($clients as $data) {
            HomepageClient::create($data);
        }
    }
}
