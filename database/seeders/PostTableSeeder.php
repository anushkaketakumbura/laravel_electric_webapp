<?php

namespace Database\Seeders;

use App\Models\Posts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 12; $i++) {
            Posts::create([
                'title' => 'Sample Post Title ' . $i,
                'slug' => Str::slug('Sample Post Title ' . $i),
                'body' => 'This is the body content of sample post ' . $i,
                'image' => 'post/tzImaBuC9iZBb6i9T8vaT1Flikgk31DLVwiW5VTi.png',
            ]);
        }
    }
}
