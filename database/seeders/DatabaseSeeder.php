<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Movie;
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
        // USERS
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

        // MOVIES
        $movies = [
            [
                'tmdb_id' => 27205,
                'title' => 'Inception',
                'overview' => 'Dom Cobb é um ladrão com a rara habilidade de entrar nos sonhos das pessoas e roubar segredos de seu subconsciente.',
                'poster_path' => '/qmDpIHrmpJINaRKAfWQfftjCdyi.jpg',
                'backdrop_path' => '/s3TBrRGB1iav7gFOCNx3H31MoES.jpg',
                'genres' => 'Action, Science Fiction, Adventure',
                'release_date' => '2010-07-16',
                'rating' => 8.8,
            ]
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}
