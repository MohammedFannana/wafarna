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
        User::insert(
            [
                'name' => 'Meshal62',
                'email'=> 'meshal.almazmomy@gmail.com',
                'phone' => '+966544607080',
                'role' => 'super_admin',
                'user_type' => 'customer',
                'password' => Hash::make('Meshal62'),
                'created_at'=> now(),
                'updated_at'=>now(),
            ]
        );

        $user = User::where('email', 'meshal.almazmomy@gmail.com')->first();

        // Create a subscription for the user
        Subscription::insert([
            'user_id' => $user->id,
            'start_subscription_data' => now(),
            'status' => 'active', // Replace with appropriate status
            'is_subscribed' => 'true',
            'price' => '0',
            'created_at'=> now(),
            'updated_at'=>now(),
        ]);
    }
}
