<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                "name" => "User $i",
                "email" => "user$i@gmail.com",
                "password" => bcrypt('123'),
                "active" => true
            ]);
        }
    }
}
