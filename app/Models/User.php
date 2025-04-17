<?php

namespace App\Models;

use Bootstrap\Column;
use Bootstrap\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Model {
  use HasApiTokens;

  #[Column] public int $id;
  #[Column] public string $email;
  #[Column] public string $username;
  #[Column] public string $password;
  #[Column] public string $name;
  #[Column] public string $picture;
  #[Column] public string $biography;
  #[Column] public string $location;
  #[Column] public string $created_at;
  #[Column] public string $updated_at;


  public function frames()
  {
      return $this->hasMany(Frame::class);
  }

  // public function comments()
  // {
  //     return $this->hasMany(Comment::class);
  // }

  static function validate(Request $request) {
    $post = $request->method() === 'POST';
    return $request->validate([
        // Fields that are required
        'email' => [($post ? 'required' : 'sometimes'), 'email', 'unique:users,email'],
        'username' => [($post ? 'required' : 'sometimes'), 'unique:users,username', 'min:6', 'max:12'],
        'password' => [($post ? 'required' : 'sometimes'), 'min:8'],
    
        // Fields that are optional
        'name' => ['sometimes', 'nullable', 'min:2', 'max:20'],
        'picture' => ['sometimes', 'nullable', 'size:64'],
        'biography' => ['sometimes', 'nullable', 'min:10', 'max:150'],
        'location' => ['sometimes', 'nullable', 'min:2', 'max:30'],
      ]);
  }

  static function booted() {
    self::saving(function (User $user) {
      if (!Hash::isHashed($user->password))
        $user->password = Hash::make($user->password);
    });
  }
}
