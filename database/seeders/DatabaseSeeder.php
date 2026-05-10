<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [

            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'type' => 'admin',
                'address' => 'Barangay San Antonio',
                'phone_num' => '09123456789',
            ],

            [
                'name' => 'Secretary User',
                'email' => 'secretary@gmail.com',
                'username' => 'secretary',
                'password' => Hash::make('secretary'),
                'type' => 'secretary',
                'address' => 'Barangay San Antonio',
                'phone_num' => '09123456780',
            ],

            [
                'name' => 'Treasurer User',
                'email' => 'treasurer@gmail.com',
                'username' => 'treasurer',
                'password' => Hash::make('treasurer'),
                'type' => 'treasurer',
                'address' => 'Barangay San Antonio',
                'phone_num' => '09123456781',
            ],

            [
                'name' => 'Kagawad User',
                'email' => 'kagawad@gmail.com',
                'username' => 'kagawad',
                'password' => Hash::make('kagawad'),
                'type' => 'kagawad',
                'address' => 'Barangay San Antonio',
                'phone_num' => '09123456782',
            ],

        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
