<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

// faker: https://fakerphp.github.io/formatters/text-and-paragraphs/

class DatabaseSeeder extends Seeder {
  function run() {
    User::create([
      'email' => 'alpha@mailinator.com',
      'username' => 'alpha',
      'password' => 'password',
    ]);

    User::create([
      'email' => 'bravo@mailinator.com',
      'username' => 'bravo',
      'password' => 'password',
    ]);

    User::create([
      'email' => 'charlie@mailinator.com',
      'username' => 'charlie',
      'password' => 'password',
    ]);
  }
}
