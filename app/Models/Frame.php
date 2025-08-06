<?php

/**
 * This file contains the Comment (Model), which represents comments on frames and handles validation logic.
 */

namespace App\Models;

use Bootstrap\Model;
use Bootstrap\Column;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Frame model representing a frame (post) record in the database
class Frame extends Model
{
  // Frame Model Fields
  #[Column] public int $id;
  #[Column] public int $user_id;
  #[Column] public string $caption;
  #[Column] public string $location;
  #[Column] public string $slug;
  #[Column] public string $image;
  #[Column] public string $camera;
  #[Column] public string $lens;
  #[Column] public string $film;
  #[Column] public string $lab;
  #[Column] public string $created_at;
  #[Column] public string $updated_at;

  // Relationship: This frame belongs to many rolls (tags)
  function rolls()
  {
    return $this->belongsToMany(Roll::class);
  }

  // Eager-load 'rolls' relationship by default
  // https://laravel.com/docs/12.x/eloquent-relationships
  protected $with = ['rolls'];

  // Method validates request data (payload) for frames (create or update)
  static function validate(Request $request)
  {
    $post = $request->method() === 'POST';
    return $request->validate([
      // Fields that are required
      'caption' => [($post ? 'required' : 'sometimes'), 'min:1', 'max:300'],
      'location' => [($post ? 'required' : 'sometimes'), 'min:1', 'max:30'],
      'image' => [($post ? 'required' : 'sometimes'), 'size:41'],
      'camera' => [($post ? 'required' : 'sometimes'), 'min:1', 'max:100'],
      'lens' => [($post ? 'required' : 'sometimes'), 'min:1', 'max:100'],
      'film' => [($post ? 'required' : 'sometimes'), 'min:1', 'max:100'],
      'lab' => [($post ? 'required' : 'sometimes'), 'min:1', 'max:100'],
    ]);
  }

  // Generate a unique slug for the frame based on date, username, and caption
  public static function generateSlug(string $username, string $caption): string
  {
    $date = now()->format('Y-m-d');
    return "{$date}-" . Str::slug($username) . '-' . Str::slug($caption);
  }
}
