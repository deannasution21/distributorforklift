<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::truncate();

        SiteSetting::create([
            'phone'     => '+62 857 8007 8367',
            'whatsapp'  => '6285780078367',
            'address'   => "PT. Distributor Forklift Indonesia\nJl. Raya Industri No. 45\nKawasan Industri Pulogadung\nJakarta Timur 13920",
            'youtube'   => null,
            'instagram' => null,
            'tiktok'    => null,
            'facebook'  => null,
        ]);
    }
}
