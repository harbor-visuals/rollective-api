<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Frame;


// faker: https://fakerphp.github.io/formatters/text-and-paragraphs/

class DatabaseSeeder extends Seeder {
  function run() {
    User::create([
      'email' => 'alpha@gmail.com',
      'username' => 'alpha',
      'password' => 'password',
    ]);

    User::create([
      'email' => 'bravo@gmail.com',
      'username' => 'bravo',
      'password' => 'password',
    ]);

    User::create([
      'email' => 'charlie@gmail.com',
      'username' => 'charlie',
      'password' => 'password',
    ]);

    User::create([
      'email' => 'delta@gmail.com',
      'username' => 'delta',
      'password' => 'password',
    ]);

    User::create([
      'email' => 'echo@gmail.com',
      'username' => 'echo',
      'password' => 'password',
    ]);

    // articles
    for ($i = 0; $i < 20; $i++) {
      Frame::create([
        'caption' => fake()->sentence(),
        'image' => Hash::make("placeholder") . '.jpg',
        'content' => fake()->word(),
        'user_id' => random_int(1, 3),
      ]);
    }


  }
}
