<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $users = [
        [
          'name' => 'Admin',
          'email' => 'admin@gmail.com',
          'role' => 'admin',
          'password' => bcrypt('qweasdzxc'),
          'email_verified_at' => '2024-05-13 17:07:11'
        ],
        [
          'name' => 'Teacher',
          'email' => 'teacher@gmail.com',
          'role' => 'teacher',
          'staffID'=> 'AB1234',
          'password' => bcrypt('qweasdzxc'),
          'email_verified_at' => '2024-05-13 17:07:11'
        ],
        [
          'name' => 'User',
          'email' => 'user@gmail.com',
          'password' => bcrypt('qweasdzxc'),
          'email_verified_at' => '2024-05-13 17:07:11'
        ]
      ];
  
      foreach ($users as $user) {
        User::create($user);
      }
    }
}
