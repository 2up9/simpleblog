<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Post, Category};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        Post::factory(10)->create();
        Category::factory(3)->create();
    }
}
