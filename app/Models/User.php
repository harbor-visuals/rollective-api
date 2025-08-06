<?php

/**
 * This file contains the User (Model), which represents users and handles validation logic.
 */

namespace App\Models;

use Bootstrap\Column;
use Bootstrap\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Validation\Rule;

// User model representing a user record in the database
class User extends Model
{
  // Enables API token authentication for the model
  use HasApiTokens;

  // User Model Fields
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

  // Relationship: This user has many frames (posts)
  public function frames()
  {
    return $this->hasMany(Frame::class);
  }

  // Relationship: This user has many comments
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  // Method validates request data (payload) for users (create or update)
  static function validate(Request $request)
  {
    $post = $request->method() === 'POST';
    $userId = $request->user()?->id;

    return $request->validate([
      // Email: required for POST, sometimes for PATCH; must be unique (ignores own email on update)
      'email' => [
        $post ? 'required' : 'sometimes',
        $post
          ? Rule::unique('users', 'email')
          : Rule::unique('users', 'email')->ignore($userId),
      ],
      // Username: required for POST, sometimes for PATCH; must be unique (ignores own username on update)
      'username' => [
        $post ? 'required' : 'sometimes',
        $post
          ? Rule::unique('users', 'username')
          : Rule::unique('users', 'username')->ignore($userId),
        'min:6',
        'max:15',
      ],
      // Password: required for POST, sometimes for PATCH
      'password' => [
        $post ? 'required' : 'sometimes',
        'min:8',
      ],

      // Optional fields: only validated if present, allow null
      'name' => ['sometimes', 'nullable', 'min:1', 'max:20'],
      'picture' => ['sometimes', 'nullable', 'size:41'],
      'biography' => ['sometimes', 'nullable', 'min:1', 'max:150'],
      'location' => ['sometimes', 'nullable', 'min:1', 'max:30'],
    ]);
  }

  // Method automatically hashes the user's password before saving if it's not already hashed
  static function booted()
  {
    self::saving(function (User $user) {
      if (!Hash::isHashed($user->password))
        $user->password = Hash::make($user->password);
    });
  }
}
