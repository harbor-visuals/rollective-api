<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Frame;
use App\Models\Comment;
use App\Models\Roll;


// faker: https://fakerphp.github.io/formatters/text-and-paragraphs/

class DatabaseSeeder extends Seeder
{
  function run()
  {
    // Empty the media folder
    File::deleteDirectory(storage_path('public/media/images'), true);

    $users = [
      [
          "email" => "alpha@gmail.com",
          "username" => "alpha",
      ],
      [
          "email" => "bravo@gmail.com",
          "username" => "bravo",
      ],
      [
          "email" => "charlie@gmail.com",
          "username" => "charlie",
      ],
      [
          "email" => "delta@gmail.com",
          "username" => "delta",
      ],
      [
          "email" => "echo@gmail.com",
          "username" => "echo",
      ],
  ];

  foreach($users as $user){
    // generate a unique filename
    $filename = Str::uuid() . ".png";

    // creation of the user
    $createUser = User::create([
      'email' => $user['email'],
      'username' => $user['username'],
      'password' => 'password',
      'name' => fake()->word(),
      'picture' => $filename,
      'biography' => fake()->sentence(),
      'location' => fake()->word(),
    ]);

    // path of the placeholder image
    $sourcePath = database_path('seeders/placeholder/profilePlaceholder.png');

    // path of where the image should be stored
    $destinationPath = 'media/images/' . $createUser->id;

    // save the placeholder file in the media user folder
    Storage::putFileAs($destinationPath, $sourcePath, $filename);
  }

    // articles
    for ($i = 0; $i < 20; $i++) {
      // generate a unique filename
      $filename = Str::uuid() . ".png";

      // creation of the frame
      $createdFrame = Frame::create([
        'user_id' => random_int(1, 5),
        'caption' => fake()->sentence(),
        'image' => $filename,
        'camera' => fake()->word(),
        'lens' => fake()->word(),
        'film' => fake()->word(),
        'lab' => fake()->word(),
        'created_at' => now()->addSeconds($i),
        'updated_at' => now()->addSeconds($i),
      ]);

      // path of the placeholder image
      $sourcePath = database_path('seeders/placeholder/framePlaceholder.png');

      // path of where the image should be stored
      $destinationPath = 'media/images/' . $createdFrame->user_id;

      // save the placeholder file in the media user folder
      Storage::putFileAs($destinationPath, $sourcePath, $filename);
    }

    // comments
    for ($i = 0; $i < 20; $i++) {
      Comment::create([
        'text' => fake()->sentence(),
        'frame_id' => random_int(1, 20),
        'user_id' => random_int(1, 5),
      ]);
    }

    $rolls = [
      'Portrait 🧑‍🦰',
      'Street 🚶‍♂️',
      'Landscape 🌄',
      'Product 📦',
      'Nature 🌿',
      'Wildlife 🦌',
      'Architecture 🏛️',
      'Travel ✈️',
      'Documentary 🎥',
      'Sport 🏅',
      'Food 🍽️',
      'Night Photography 🌌',
      'Low Light 🔦',
      'Macro 🔍',
      'Abstract 🎨',
      'Minimalism ⚪',
      'Underwater 🌊',
      'Wedding 💍',
      'Fashion 👗',
      'Action 🏃‍♂️',
      'Event / Concert 🎤',
      'Black & White ⚫⚪',
      'Aerial 🚁',
      'Commercial 💼',
      'Self-Portrait 🤳',
      'Conceptual 💡',
      'Expired ⏳',
      'Moody 🌫️',
      'Automotive 🚗',
      'Long Exposure 🌀',
    ];

    foreach ($rolls as $roll) {
      Roll::create([
        'name' => $roll,
      ]);
    };
  }
}
