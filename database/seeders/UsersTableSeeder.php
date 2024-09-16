<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 3; $i++){
            User::create([
                "name" => "User $i",
                "email" => "user$i@gmail.com",
                "password" => bcrypt('Aa123456'),
                "active" => true
            ]);
        }
    }
}
