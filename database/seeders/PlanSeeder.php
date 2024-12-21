<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::insert([

            [
                'name' => 'اشتراك مجاني',
                'price' => '0',
                'period' => '2'

            ],

            [
                'name' => 'اشتراك شهري',
                'price' => '100',
                'period' => '1'

            ],

            [
                'name' => 'اشتراك سنوي',
                'price' => '1000',
                'period' => '12'
            ]


        ]);
    }
}
