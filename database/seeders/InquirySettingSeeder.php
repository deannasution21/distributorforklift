<?php

namespace Database\Seeders;

use App\Models\InquirySetting;
use Illuminate\Database\Seeder;

class InquirySettingSeeder extends Seeder
{
    public function run(): void
    {
        InquirySetting::truncate();

        InquirySetting::create([
            'heading' => 'Kami siap membantu Anda.',
            'intro'   => 'Apakah Anda memiliki pertanyaan atau membutuhkan saran personal? Tim ahli kami siap membantu Anda menemukan solusi yang tepat — secara individual dan cepat.',
            'hours'   => 'Senin hingga Jumat',
        ]);
    }
}
