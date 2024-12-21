<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::insert(
            [
                'name' => 'Meshal62',
                'email'=> 'meshal.almazmomy@gmail.com',
                'phone' => '+966544607080',
                'role' => 'super_admin',
                'user_type' => 'customer',
                'password' => Hash::make('Meshal62'),

            ]
        );

        // Create a subscription for the user
        Subscription::create([
            'user_id' => $user->id,
            'start_subscription_data' => now(),
            'status' => 'active', // Replace with appropriate status
            'is_subscribed' => 'true',
            'price' => '0',
        ]);
    }
}
