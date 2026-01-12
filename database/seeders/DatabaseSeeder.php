<?php

namespace Database\Seeders;

use App\Models\User;
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
 User::factory()->create([
 'name' => 'antonio',
 'email' => 'antonio@gmail.com',
 'password' => bcrypt('admin123'), 
 'role' => 'admin',
 ]);
 User::factory()->create([
 'name' => 'tiago',
 'email' => 'tiago@gmail.com',
 'password' => bcrypt('admin123'), 
 'role' => 'admin',
 ]);


 User::factory()->create([
 'name' => 'Daniel',
 'email' => 'daniel@gmail.com',
 'password' => bcrypt('zeh123'),
 'role' => 'user',
 ]);
 }

}
