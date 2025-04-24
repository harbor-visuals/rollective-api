<?php

namespace App\Models;

use Bootstrap\Model;
use Bootstrap\Column;
use Illuminate\Http\Request;

class Frame extends Model {
  #[Column] public int $id;
  #[Column] public int $user_id;
  #[Column] public string $caption;
  #[Column] public string $image;
  #[Column] public string $camera;
  #[Column] public string $lens;
  #[Column] public string $film;
  #[Column] public string $lab;
  #[Column] public string $created_at;
  #[Column] public string $updated_at;

  function rolls() {
    return $this->belongsToMany(Roll::class);
  }

  protected $with = ['rolls'];

  static function validate(Request $request) {
    $post = $request->method() === 'POST';
    return $request->validate([
      // Fields that are required
      'caption' => [($post ? 'required' : 'sometimes'),'min:1','max:300'],
      'image' => [($post ? 'required' : 'sometimes'), 'size:68'],

      // Fields that are optional
      'camera' => ['sometimes', 'nullable', 'string', 'max:100'],
      'lens' => ['sometimes', 'nullable', 'string', 'max:100'],
      'film' => ['sometimes', 'nullable', 'string', 'max:100'],
      'lab' => ['sometimes', 'nullable', 'string', 'max:100'],
    ]);
  }
}
