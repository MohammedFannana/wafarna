<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('homes')->insert([
            'name' => 'وفرنا لتخفيضات',
            'description' => '"اِستَفِدِ الآنَ مِنْ عُروضِنَا الخَاصَّةِ عَلَى الْبَضَائِعِ الْمُخَفَّضَةِ، خُصُوماتٌ هَائِلَةٌ عَلَى مَجْمُوعَةٍ وَاسِعَةٍ مِنَ الْمُنْتَجَاتِ، لا تَفُوتِ الْفُرْصَةَ!',
            'image' => 'image/ph1.png',
            'role' => 'introduction',
            
        ]);

        DB::table('homes')->insert([
            'name' => 'منصة وفرنا للبضائع المخفضة',
            'description' => 'هو وجهتك المثالية للتسوق الذكي والموفر. يقدم الموقع مجموعة واسعة من البضائع المخفضة في مختلف الفئات مثل الإلكترونيات، الملابس، الأدوات المنزلية، ومستحضرات التجميل. يتميز الموقع بعروض وخصومات حصرية يومية، مما يتيح لك فرصة العثور على منتجات عالية الجودة بأسعار مغرية.',
            'image' => 'image/ph2.png',
            'role' => 'platform_details',
            
        ]);
    }
}
