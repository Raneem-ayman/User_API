<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        $post = Post::create([
            'user_id' => $user->id,
            'title' => 'Test Post',
            'content' => 'This is a test post.'
        ]);

        $user->photos()->createMany([
            ['path' => 'path/to/user/photo1.jpg'],
            ['path' => 'path/to/user/photo2.jpg']
        ]);

        $post->photos()->create([
            'path' => 'path/to/post/photo.jpg',
        ]);
    }
}
