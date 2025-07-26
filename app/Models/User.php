<?php

namespace App\Models;

use Bootstrap\Column;
use Bootstrap\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Validation\Rule;

class User extends Model
{
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

  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  static function validate(Request $request)
  {
    $post = $request->method() === 'POST';
    $userId = $request->user()?->id;

    return $request->validate([
      // Required on POST, sometimes on PATCH
      'email' => [
        $post ? 'required' : 'sometimes',
        $post
          ? Rule::unique('users', 'email')
          : Rule::unique('users', 'email')->ignore($userId),
      ],
      'username' => [
        $post ? 'required' : 'sometimes',
        $post
          ? Rule::unique('users', 'username')
          : Rule::unique('users', 'username')->ignore($userId),
        'min:6',
        'max:15',
      ],
      'password' => [
        $post ? 'required' : 'sometimes',
        'min:8',
      ],

      // Optional fields
      'name' => ['sometimes', 'nullable', 'min:1', 'max:20'],
      'picture' => ['sometimes', 'nullable', 'size:41'],
      'biography' => ['sometimes', 'nullable', 'min:1', 'max:150'],
      'location' => ['sometimes', 'nullable', 'min:1', 'max:30'],
    ]);
  }

  static function booted()
  {
    self::saving(function (User $user) {
      if (!Hash::isHashed($user->password))
        $user->password = Hash::make($user->password);
    });
  }
}
