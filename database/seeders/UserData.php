<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'admin',
                'username' => 'admin',
                'password' => bcrypt('12345'),
                'level' => 1,
                'email' => 'admin@gmail.com',
                'foto' => 'profile.png',
            ],
            [
                'name' => 'Owner',
                'username' => 'Owner',
                'password' => bcrypt('12345'),
                'level' => 2,
                'email' => 'owner@gmail.com',
                'foto' => 'profile.png',
            ],
            [
                'name' => 'kasir',
                'username' => 'kasir',
                'password' => bcrypt('12345'),
                'level' => 3,
                'email' => 'kasir@gmail.com',
                'foto' => 'profile.png',
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
