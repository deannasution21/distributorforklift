<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminUserSeeder::class);
        $this->call(HeroSliderSeeder::class);
        $this->call(HomepageAboutSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(NavItemSeeder::class);
        $this->call(ContactPageSeeder::class);
        $this->call(InquirySettingSeeder::class);
        $this->call(SiteSettingSeeder::class);
        $this->call(HomepageShowcaseSeeder::class);
    }
}
