<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Frame;
use App\Models\Comment;


// faker: https://fakerphp.github.io/formatters/text-and-paragraphs/

class DatabaseSeeder extends Seeder {
  function run() {
    // user
    User::create([
      'email' => 'alpha@gmail.com',
      'username' => 'alpha',
      'password' => 'password',
      'name' => fake()->word(),
      'picture' => hash('sha256', microtime(true)) . '.jpg',
      'biography' => fake()->sentence(),
      'location' => fake()->word(),
    ]);

    User::create([
      'email' => 'bravo@gmail.com',
      'username' => 'bravo',
      'password' => 'password',
      'name' => fake()->word(),
      'picture' => hash('sha256', microtime(true)) . '.jpg',
      'biography' => fake()->sentence(),
      'location' => fake()->word(),
    ]);

    User::create([
      'email' => 'charlie@gmail.com',
      'username' => 'charlie',
      'password' => 'password',
      'name' => fake()->word(),
      'picture' => hash('sha256', microtime(true)) . '.jpg',
      'biography' => fake()->sentence(),
      'location' => fake()->word(),
    ]);

    User::create([
      'email' => 'delta@gmail.com',
      'username' => 'delta',
      'password' => 'password',
      'name' => fake()->word(),
      'picture' => hash('sha256', microtime(true)) . '.jpg',
      'biography' => fake()->sentence(),
      'location' => fake()->word(),
    ]);

    User::create([
      'email' => 'echo@gmail.com',
      'username' => 'echo',
      'password' => 'password',
      'name' => fake()->word(),
      'picture' => hash('sha256', microtime(true)) . '.jpg',
      'biography' => fake()->sentence(),
      'location' => fake()->word(),
    ]);

    // articles
    for ($i = 0; $i < 20; $i++) {
      Frame::create([
        'user_id' => random_int(1, 5),
        'caption' => fake()->sentence(),
        'image' => hash('sha256', microtime(true)) . '.jpg',
        'camera' => fake()->word(),
        'lens' => fake()->word(),
        'film' => fake()->word(),
        'lab' => fake()->word(),
        'created_at' => now()->addSeconds($i),
        'updated_at' => now()->addSeconds($i),
      ]);
    }

    // comments
    for ($i = 0; $i < 20; $i++) {
      Comment::create([
        'text' => fake()->sentence(),
        'frame_id' => random_int(1, 20),
        'user_id' => random_int(1, 5),
      ]);
    }


  }
}
